<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_francais' => 'required|string',
            'nom_arabe' => 'required|string',
            'prenom_francais' => 'required|string',
            'prenom_arabe' => 'required|string',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string',
            'sex' => 'required|string',
            // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string',
            'password' => 'required|string',
            'username' => 'required|string',
            'user_type' => 'required|string',
            'adresse' => 'required|string',
        ]);

       

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        return response()->json(['user_id' => $user->id], 201);
    }
}
