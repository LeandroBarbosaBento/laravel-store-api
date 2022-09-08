<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'name' => 'required',
            'type' => 'required',
        ]);

        $userData = $request->only(
            'email', 'password', 'name', 'type'
        );

        $userData['password'] = bcrypt($userData['password']);

        if(!$user = $user->create($userData))
        {
            abort(500, 'Error to create a new user!');
        }

        return response()->json([
            'data' => [
                'user' => $user,
            ]
        ]);
    }
}
