<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AntrianResource extends JsonResource
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
            'id_pasien' => $this->id_pasien,
            'id_dokter' => $this->id_dokter,
            'id_poli' => $this->id_poli,
            'tgl_kun' => $this->tgl_kun,
            'pembayaran' => $this->pembayaran,
            'no_antrian' => $this->no_antrian,
            'nama_pasien' => $this->pasien->name,
            'dokter' => $this->dokter->name,
            'poli' => $this->poli->pilpol,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
