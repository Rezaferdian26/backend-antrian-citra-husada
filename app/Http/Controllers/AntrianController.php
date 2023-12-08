<?php

namespace App\Http\Controllers;

use App\Http\Resources\AntrianResource;
use App\Models\Antrian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_dokter' => 'required',
            'id_poli' => 'required',
            'pembayaran' => 'required|string',
        ]);

        $nomorAntrianTerakhir = Antrian::where('id_poli', $data['id_poli'])
            ->whereDate('created_at', Carbon::today())
            ->max('no_antrian') + 1;

        $data['id_pasien'] = auth()->user()->id;
        $data['tgl_kun'] = Carbon::today();
        $data['no_antrian'] = $nomorAntrianTerakhir;

        Antrian::create($data);

        return response()->json([
            'message' => 'Antrian berhasil ditambahkan',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idPasien)
    {
        $antrian = Antrian::where('id_pasien', $idPasien)->first();
        return new AntrianResource($antrian);
    }

    public function showByDokter()
    {
        if (auth()->user()->hasRole('dokter')) {
            $antrian = Antrian::where('id_dokter', auth()->user()->id)->orderBy('no_antrian', 'asc')->get();
            return AntrianResource::collection($antrian);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $antrian = Antrian::findOrFail($id);

        // Perbarui nomor antrian untuk antrian yang tersisa di poli yang sama
        $poliId = $antrian->id_poli;
        $tanggal = $antrian->tgl_kun;

        // Ambil antrian sebelumnya
        $antrianSebelumnya = Antrian::where('id_poli', $poliId)
            ->where('tgl_kun', $tanggal)
            ->where('no_antrian', '<', $antrian->no_antrian)
            ->orderBy('no_antrian', 'desc')
            ->first();

        return $antrianSebelumnya;

        if ($antrianSebelumnya) {
            // Perbarui nomor antrian untuk antrian yang tersisa
            Antrian::where('poli_id', $poliId)
                ->where('tanggal', $tanggal)
                ->where('no_antrian', '>', $antrianSebelumnya->no_antrian)
                ->where('no_antrian', '<=', $antrian->no_antrian)
                ->update(['no_antrian' => DB::raw('no_antrian - 1')]);
        }

        // Hapus antrian yang sudah selesai
        $antrian->delete();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
