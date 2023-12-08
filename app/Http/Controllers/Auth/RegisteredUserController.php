<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'string'],
            'tgl_lahir' => ['required', 'date'],
            'umur' => ['required', 'numeric'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'numeric'],
            'no_identitas_pasien' => ['required', 'numeric'],
            'no_bpjs_pasien' => ['required', 'numeric'],
            'username' => ['required', 'string', 'lowercase', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'umur' => $request->umur,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_identitas_pasien' => $request->no_identitas_pasien,
            'no_bpjs_pasien' => $request->no_bpjs_pasien,
        ]);

        $user->assignRole('pasien');

        // event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}
