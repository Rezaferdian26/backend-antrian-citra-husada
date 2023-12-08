<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RekamMedisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'no_rekam' => $this->no_rekam,
            'pasien' => $this->pasien->name,
            'jenis_kelamin' => $this->pasien->jenis_kelamin,
            'tgl_lahir_pasien' => $this->pasien->tgl_lahir,
            'alamat' => $this->pasien->alamat,
            'dokter' => $this->dokter->name,
            'jenis_rawat' => $this->jenis_rawat,
            'tgl_kun' => $this->tgl_kun,
            'diagnosa' => $this->diagnosa,
            'resep' => $this->resep,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
