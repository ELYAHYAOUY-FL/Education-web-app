<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Groupe;
use Illuminate\Http\Request;

class EleveController extends Controller
{
    public function index()
    {
        $eleves = Eleve::with('groupe','user' , 'eleve_exams')->get();
        return response()->json($eleves);
    }

    public function getById($userId)
{
    $eleves= Eleve::with('groupe', 'groupe.emploiTemp')->where('user_id', $userId)->first();

    if (!$eleves) {
        return response()->json(['error' => 'elevesnot found'], 404);
    }

    return response()->json($eleves);
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'CNE' => 'required|string|unique:eleves,CNE',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

            'user_id' => 'required',
            'groupe_id' => 'required',
        ]);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('photos'), $photoName);

            $validatedData['photo'] = $photoName;
        }
    
        $eleve = Eleve::create($validatedData);
        return response()->json(['eleve_id' => $eleve->id]);
        
    }
    public function destroy($id)
    {
          $eleve = Eleve::findOrFail($id);
    
        // Remove the professor's association with subjects
        $eleve->eleve_professuers()->update(['eleve_id' => null]);
        $professeur->groups()->update(['group_id' => null]);
        // Delete the professor
        $eleve->delete();
    
        return response()->json(['message' => 'prof deleted successfully']);
    }
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire de modification
        $validatedData = $request->validate([
            'nom_francais' => 'required|string',
            'nom_arabe' => 'required|string',
            'prenom_francais' => 'required|string',
            'prenom_arabe' => 'required|string',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string',
            'sex' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de la photo
            'CNE' => 'required|string|unique:eleves,CNE,' . $id,
            'classe_id' => 'required',
        ]);
    
        try {
            // Trouver l'étudiant à mettre à jour
            $eleve = Eleve::findOrFail($id);
    
            // Mettre à jour les champs modifiés
            $eleve->nom_francais = $validatedData['nom_francais'];
            $eleve->nom_arabe = $validatedData['nom_arabe'];
            $eleve->prenom_francais = $validatedData['prenom_francais'];
            $eleve->prenom_arabe = $validatedData['prenom_arabe'];
            $eleve->date_naissance = $validatedData['date_naissance'];
            $eleve->lieu_naissance = $validatedData['lieu_naissance'];
            $eleve->sex = $validatedData['sex'];
            $eleve->CNE = $validatedData['CNE'];
            $eleve->classe_id = $validatedData['classe_id'];
    
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = time() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('photos'), $photoName);
                $eleve->photo = $photoName;
            }
    
            // Enregistrer les modifications dans la base de données
            $eleve->save();
    
            // Réponse de succès
            return response()->json(['message' => 'Étudiant mis à jour avec succès'], 200);
        } catch (\Exception $e) {
            // Gérer les erreurs
            return response()->json(['message' => 'Erreur lors de la mise à jour de l\'étudiant'], 500);
        }
    }
    
    
}
