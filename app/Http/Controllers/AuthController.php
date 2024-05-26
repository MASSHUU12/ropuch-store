<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request, string $role = "user"): Response
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        // Generates a random salt. The salt is a hexadecimal string.
        // The length of the salt is between 128 and 256 characters (64 to 128 bytes).
        $salt = bin2hex(random_bytes(random_int(64, 128)));

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'salt' => $salt,
            'password' => bcrypt($fields['password'], ['salt' => $salt]),
        ]);

        $token = $user->createToken('user_token', [$role])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Logged out.'
        ]);
    }

    public function login(Request $request): Response
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials.'
            ], 401);
        }

        $employee = $user->employee;
        $role = $employee === null ? "user" : $employee->role;
        $token = $user->createToken('user_token', [$role])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
