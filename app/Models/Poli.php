<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'poli';

    protected $guarded = [];

    public function antrian()
    {
        return $this->belongsTo(Antrian::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
