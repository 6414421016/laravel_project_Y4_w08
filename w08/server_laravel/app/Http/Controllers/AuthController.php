<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fiels = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $user = User::create([
            'name' => $fiels['name'],
            'email' => $fiels['email'],
            'password' => bcrypt($fiels['password'])
        ]);
        $token = $user->createToken($request->name)->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response()->json($response, 201);
    }


    public function login(Request $request) {
        $files = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $files['email'])->first();

        if (!$user || !Hash::check($files['password'], $user->password)) {
            return response([
                'message' => 'password is incorrect'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function logout(Request $request) {
        $user = $request->user();
        
        if ($user) {
            $user->tokens()->delete();

            return response([
                'message' => 'You are logged out.'
            ], 200);
        } else {
            return response([
                'message' => 'No authenticated user found.'
            ], 401);
        }
    }
}
