<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only(
            'email', 'password'
        );

        if(!auth()->attempt($credentials))
        {
            abort(401, 'Invalid Credentials!');
        }

        $token = auth()->user()->createToken('new-token');

        return response()->json([
            'data' => [
                'token' => $token->plainTextToken,
                'user' => auth()->user(),
            ]
        ]);

    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([], 204);

    }


}
