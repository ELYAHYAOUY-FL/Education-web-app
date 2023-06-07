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
    $eleves= Eleve::with('eleve_exams.note', 'eleve_exams.matire','groupe','user', 'groupe.matieres.exams.note','groupe.emploiTemp','eleve_exams.note')->where('user_id', $userId)->first();

    if (!$eleves) {
        return response()->json(['error' => 'elevesnot found'], 404);
    }

    return response()->json($eleves);
}

public function getByIdlastNoteBYmatire($userId)
{
    $eleve = Eleve::with(['eleve_exams.note', 'eleve_exams.matire'])
        ->where('user_id', $userId)
        ->first();

        if (!$eleve) {
            return response()->json(['error' => 'Eleve not found'], 404);
        }
    
        $lastNotes = [];

        foreach ($eleve->eleve_exams as $eleveExam) {
            $matiereId = $eleveExam->matiere_id;
            $note = $eleveExam->note;
            $matiere = $eleveExam->matire;
    
            if ($note) {
                if (!isset($lastNotes[$matiereId]) || $note['created_at'] > $lastNotes[$matiereId]['note']['created_at']) {
                    $lastNotes[$matiereId] = [
                        'note' => $note,
                        'matiere' => $matiere
                    ];
                }
            }
        }
    
        $eleve->last_notes = $lastNotes;
    
        return response()->json($eleve->last_notes);

}



public function getByIdlastNote($userId)
{
    $eleve = Eleve::with(['eleve_exams.note', 'eleve_exams.matire'])
        ->where('user_id', $userId)
        ->first();

    if (!$eleve) {
        return response()->json(['error' => 'Eleve not found'], 404);
    }

    $lastNotes = [];

    foreach ($eleve->eleve_exams as $eleveExam) {
        $matiereId = $eleveExam->matiere_id;
        $note = $eleveExam->note;
        $matiere = $eleveExam->matire;

        if ($note) {
            if (!isset($lastNotes[$matiereId]) || $note['created_at'] > $lastNotes[$matiereId]['note']['created_at']) {
                $lastNotes[$matiereId] = [
                    'note' => $note,
                    'matiere' => $matiere
                ];
            }
        }
    }

    $lastNotes = array_values($lastNotes); // Convert associative array to indexed array

    return response()->json(['last_notes' => $lastNotes]);
}




public function getContenuCahierNotes($userId)
{
    $eleve = Eleve::with('groupes.professeur.carnetNotes')->where('user_id', $userId)->first();

    if (!$eleve) {
        return response()->json(['error' => 'Eleve not found'], 404);
    }

    $contenusCahiersNotes = [];

    foreach ($eleve->groupes as $groupe) {
        $professeur = $groupe->professeur;
        $carnetNote = $professeur->carnetNotes->last();

        if ($carnetNote) {
            $contenusCahiersNotes[] = [
                'groupe' => $groupe,
                'contenu' => $carnetNote->contenu
            ];
        }
    }

    return response()->json($contenusCahiersNotes);
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
        // $professeur->groups()->update(['group_id' => null]);
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
