<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('jenis_kelamin')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->integer('umur')->nullable();
            $table->text('alamat')->nullable();
            $table->text('no_hp')->nullable();
            $table->rememberToken();

            $table->string('no_identitas_pasien')->nullable();
            $table->string('no_bpjs_pasien')->nullable();
            $table->string('keterangan_pasien')->nullable();

            $table->string('jadwal_dokter')->nullable();
            $table->unsignedBigInteger('poli_id')->nullable();
            $table->foreign('poli_id')->references('id')->on('poli');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
