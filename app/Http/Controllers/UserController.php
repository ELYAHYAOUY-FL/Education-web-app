<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire ici
        
        $user = User::create($request->all());
        // Autres actions à effectuer après la création de l'utilisateur
        
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données du formulaire ici
        
        $user = User::findOrFail($id);
        $user->update($request->all());
        // Autres actions à effectuer après la mise à jour de l'utilisateur
        
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        // Autres actions à effectuer après la suppression de l'utilisateur
        
        return redirect()->route('users.index');
    }
}
