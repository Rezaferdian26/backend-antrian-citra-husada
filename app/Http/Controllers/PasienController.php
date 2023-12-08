<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasien = User::role('pasien')->get();

        return response()->json([
            'data' => $pasien,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'no_identitas' => 'required|string',
            'no_bpjs' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'tgl_lahir' => 'required|date',
            'umur' => 'required|integer',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'poli' => 'required|string'
        ]);

        $pasien = User::create($data);



        return response()->json([
            'data' => $pasien,
            'message' => 'Pasien created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pasien = User::find($id);

        return response()->json([
            'data' => $pasien,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'no_identitas' => 'required|string',
            'no_bpjs' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'tgl_lahir' => 'required|date',
            'umur' => 'required|integer',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $pasien = User::find($id);
        $pasien->update($data);

        return response()->json([
            'data' => $pasien,
            'message' => 'Pasien updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = User::find($id);
        $pasien->delete();

        return response()->json([
            'message' => 'Pasien deleted successfully',
        ]);
    }
}
