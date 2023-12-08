<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function poli()
    {
        return $this->hasOne(Poli::class, 'id', 'id_poli');
    }

    public function pasien()
    {
        return $this->hasOne(User::class, 'id', 'id_pasien');
    }

    public function dokter()
    {
        return $this->hasOne(User::class, 'id', 'id_dokter');
    }
}
