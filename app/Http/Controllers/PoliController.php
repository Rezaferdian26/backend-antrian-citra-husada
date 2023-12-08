<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $poli = Poli::all();
        return response()->json([
            'data' => $poli
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'pilpol' => 'required|string'
        ]);

        $poli = Poli::create($data);
        return response()->json([
            'data' => $poli,
            'message' => 'Poli created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $poli = Poli::find($id);
        return response()->json([
            'data' => $poli
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'pilpol' => 'required|string'
        ]);

        $poli = Poli::find($id);
        $poli->update($data);
        return response()->json([
            'data' => $poli,
            'message' => 'Poli updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $poli = Poli::find($id);
        $poli->delete();

        return response()->json([
            'message' => 'Poli deleted successfully',
        ]);
    }
}
