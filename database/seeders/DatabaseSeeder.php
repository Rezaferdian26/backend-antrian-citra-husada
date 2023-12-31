<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $roleDokter = Role::create(['name' => 'dokter']);
        $roleOperator = Role::create(['name' => 'operator']);
        $rolePasien = Role::create(['name' => 'pasien']);

        $dokter = \App\Models\User::factory()->create([
            'name' => 'dokter',
            'username' => 'dokter',
        ]);
        $dokter->assignRole($roleDokter);

        $pasien = \App\Models\User::factory()->create([
            'name' => 'pasien',
            'username' => 'pasien',
        ]);
        $pasien->assignRole($rolePasien);

        $operator = \App\Models\User::factory()->create([
            'name' => 'operator',
            'username' => 'operator',
        ]);
        $operator->assignRole($roleOperator);
    }
}
