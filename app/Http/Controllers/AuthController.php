<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
// use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            
        ]);

        $logged = Auth::attempt(
            $request->only('email', 'password')
        );

        if ($logged) {
            return response()->json([
                'status' => true,
                'user' => Auth::user(),
            ]);
        }
        return response()->json(['status' => false]);
    }

    public function logout(): JsonResponse
    {
        auth()->guard('web')->logout();
        return response()->json(null, 204);
    }

    public function user(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}

