<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {

    public function login(Request $request){
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $usuario = User::where('email', $request->email)->first();

            if(!$usuario || !Hash::check($request->password, $usuario->password)){
                throw ValidationException::withMessages([
                                'email' => ['As credenciais fornecidas estão incorretas.'],
                 ]);
            }

            $token = $usuario->createToken('auth_token')->plainTextToken;

            return response()->json([
            'mensagem'     => 'Login realizado com sucesso!',
            'usuario'      => $usuario,
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ], 200);
    }
}

