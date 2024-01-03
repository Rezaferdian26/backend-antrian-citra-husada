<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return new UserResource($request->user());
});

Route::resource('poli', PoliController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

Route::resource('pasien', PasienController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

Route::resource('dokter', DokterController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
Route::get('get-dokter-by-poli/{poli}', [DokterController::class, 'getDokterByPoli'])->middleware('auth:sanctum');

Route::get('operator/me', [OperatorController::class, 'me'])->middleware('auth:sanctum');

Route::resource('antrian', AntrianController::class)->only(['index', 'show', 'store', 'update', 'destroy'])->middleware('auth:sanctum');
Route::get('get-antrian-by-dokter', [AntrianController::class, 'showByDokter'])->middleware('auth:sanctum');

Route::post('rekam-medis', [RekamMedisController::class, 'store'])->middleware('auth:sanctum');
Route::get('rekam-medis', [RekamMedisController::class, 'index'])->middleware('auth:sanctum');
Route::get('rekam-medis-pasien', [RekamMedisController::class, 'showForPasien'])->middleware('auth:sanctum');
Route::get('rekam-medis-dokter', [RekamMedisController::class, 'showForDokter'])->middleware('auth:sanctum');
