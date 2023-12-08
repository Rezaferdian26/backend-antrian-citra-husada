<?php

namespace App\Http\Controllers;

use App\Http\Resources\RekamMedisResource;
use App\Models\Antrian;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekammedis = RekamMedis::all();

        return RekamMedisResource::collection($rekammedis);
    }

    public function showForPasien()
    {
        $rekammedis = RekamMedis::where('id_pasien', auth()->user()->id)->get();
        return RekamMedisResource::collection($rekammedis);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'no_rekam' => 'required',
            'id_pasien' => 'required',
            'id_dokter' => 'required',
            'jenis_rawat' => 'required|string',
            'tgl_kun' => 'required',
            'diagnosa' => 'required|string',
            'resep' => 'required|string'
        ]);

        $id_antrian = Antrian::where('id_pasien', $data['id_pasien'])->first()->id;
        $antrian = Antrian::findOrFail($id_antrian);

        // Perbarui nomor antrian untuk antrian yang tersisa di poli yang sama
        $poliId = $antrian->id_poli;
        $tanggal = $antrian->tgl_kun;

        // Ambil antrian sebelumnya
        $antrianSebelumnya = Antrian::where('id_poli', $poliId)
            ->where('tgl_kun', $tanggal)
            ->where('no_antrian', '>', $antrian->no_antrian)
            ->orderBy('no_antrian', 'asc')
            ->first();

        if ($antrianSebelumnya) {
            // Perbarui nomor antrian untuk antrian yang tersisa
            Antrian::where('id_poli', $poliId)
                ->where('tgl_kun', $tanggal)
                ->where('no_antrian', '>=', $antrianSebelumnya->no_antrian)
                ->update(['no_antrian' => DB::raw('no_antrian - 1')]);
        }

        // Hapus antrian yang sudah selesai
        $antrian->delete();

        RekamMedis::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Rekam Medis Berhasil dan antrian berkurang',
        ], 201);
    }
}
