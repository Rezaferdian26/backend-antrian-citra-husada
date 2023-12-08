<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pasien()
    {
        return $this->hasOne(User::class, 'id', 'id_pasien');
    }

    public function dokter()
    {
        return $this->hasOne(User::class, 'id', 'id_dokter');
    }
}
