<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);
            if (!auth()->attempt($credentials)) {
                return response()->json([
                    'message' => 'Email and password do not match.',
                    'errors' => [
                        'password' => [
                            'Incorrect Email/ Password!'
                        ],
                    ]
                ], 422);
            }

            $user = User::where('email', $request->email)->first();
            $authToken = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'access_token' => $authToken,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong! Please try again!'
            ], 500);
            Log::error("Error in api Login:" . $e);
        }
    }
}
