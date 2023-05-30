<?php

namespace App\Http\Controllers;
use App\Models\Matiere;


use App\Models\Professeur;

use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
 
public function index()
{
    $professors = Professeur::with('virement', 'matieres', 'matieres.classes')->get();

    return response()->json($professors);
}

public function getProfById($userId)
{
    $professeur= Professeur::with('matiere', 'matiere.emploiTemp')->where('user_id', $userId)->first();

    if (!$professeur) {
        return response()->json(['error' => 'professeur$professeurnot found'], 404);
    }

    return response()->json($professeur);
}
public function destroy($id)
{
    $professeur = Professeur::findOrFail($id);

    // Remove the professor's association with subjects
    $professeur->matieres()->update(['professeur_id' => null]);

    // Delete the professor
    $professeur->delete();

    return response()->json(['message' => 'prof deleted successfully']);
}


public function store(Request $request)
{
    $validatedData = $request->validate([
        'prenom' => 'required',
        'nom' => 'required',
        'date_naissance' => 'required',
        'lieu_naissance' => 'required',
        'tel' => 'required',
        'diplom' => 'required',
        'address' => 'required',
        'sex' => 'required',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'virement_id' => 'required',
    ]);
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoName = time() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('photos'), $photoName);

        $validatedData['photo'] = $photoName;
    }

    $professuer = Professeur::create($validatedData);

    // $professuer = Professuer::create($validatedData);

    return response()->json(['professuer_id' => $professuer->id]);
}







}
