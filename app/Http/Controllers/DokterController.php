<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\DokterResource;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokter = User::role('dokter')->dokterFields()->get();

        return DokterResource::collection($dokter);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'name' => 'required|string',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'jadwal_dokter' => 'required|string',
            'poli_id' => 'required'
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $user->assignRole('dokter');


        return response()->json([
            'success' => true,
            'message' => 'Dokter created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dokter = User::find($id);

        return response()->json($dokter);
    }

    public function getDokterByPoli($id)
    {
        $dokter = User::role('dokter')->dokterFields()->where('poli_id', $id)->get();
        return DokterResource::collection($dokter);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dokter = User::find($id);
        $data = $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'jadwal_dokter' => 'required|string',
            'poli_id' => 'required'
        ]);

        if ($data['username'] === $dokter->username) {
            unset($data['username']);
        }

        $dokter->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Dokter updated successfully',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokter = User::find($id);

        $dokter->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dokter deleted successfully',
        ]);
    }
}
