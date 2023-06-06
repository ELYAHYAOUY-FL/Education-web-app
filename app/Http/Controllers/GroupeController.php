<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupe;

class GroupeController extends Controller
{
   
    
    public function index()
    {
        $groupes = Groupe::with('niveau_scolaire','eleves' ,'eleves.user')->get();
        return response()->json($groupes);
    }

    public function getGroupStudents($groupId)
    {
        $group = Groupe::findOrFail($groupId);
        $students = $group->eleves()->with('user')->get();
        return response()->json($students);
    }
    
    public function addGroupe(Request $request, $niveauScolaireId)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'capacite' => 'required|integer',
            'salle' => 'required',
        ]);

        $groupe = new Groupe();
        $groupe->nom = $validatedData['nom'];
        $groupe->capacity = $validatedData['capacite'];
        $groupe->salle = $validatedData['salle'];
        $groupe->niveau_scolaire_id = $niveauScolaireId;
        $groupe->save();

        return response()->json(['message' => 'Groupe ajouté avec succès'], 201);
    }
}
