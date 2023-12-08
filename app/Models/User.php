<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function antrian()
    {
        return $this->belongsTo(Antrian::class, 'id_pasien');
    }

    public function scopeDokterFields($query)
    {
        return $query->select('id', 'name', 'username', 'email', 'jenis_kelamin', 'tgl_lahir',  'no_hp', 'alamat', 'umur', 'jadwal_dokter', 'poli_id', 'created_at', 'updated_at');
    }
}
