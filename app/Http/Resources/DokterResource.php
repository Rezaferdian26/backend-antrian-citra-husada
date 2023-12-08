<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DokterResource extends JsonResource
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
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tgl_lahir' => $this->tgl_lahir,
            'umur' => $this->umur,
            'poli' => $this->poli,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'jadwal_dokter' => $this->jadwal_dokter,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
