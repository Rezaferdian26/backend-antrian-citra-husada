<?php

namespace App\Http\Controllers;

use App\Http\Resources\RekapitulasiResource;
use App\Models\RekamMedis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperatorController extends Controller
{
    public function me()
    {
        $user = auth()->user();
        return response()->json([
            'data' => $user
        ]);
    }

    public function rekapitulasi(string $date)
    {
        $dokterWithJumlahPasien = DB::table('rekam_medis')
            ->join('users', 'rekam_medis.id_dokter', '=', 'users.id')
            ->select('users.id as id_dokter', 'users.name as dokter', DB::raw('count(id_pasien) as total_pasien'), 'tgl_kun')->groupBy('tgl_kun')->orderBy('tgl_kun')->where('tgl_kun', $date)->get();
        return $dokterWithJumlahPasien;
    }
}
