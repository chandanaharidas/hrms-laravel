<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // find user by email
        $user = User::where('email', $request->email)->first();

        // check password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid email or password'
            ], 401);
        }

        // return user details
        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'user' => $user,
            'role' => $user->role, // admin / employee
        ]);
    }
} 