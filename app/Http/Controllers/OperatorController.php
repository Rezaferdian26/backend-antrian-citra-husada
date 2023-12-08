<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function me()
    {
        $user = auth()->user();
        return response()->json([
            'data' => $user
        ]);
    }
}
