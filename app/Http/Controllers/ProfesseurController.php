<?php

namespace App\Http\Controllers;
use App\Models\Matiere;


use Illuminate\Http\Request;
use App\Models\Professeur;

class ProfesseurController extends Controller
{
 
public function index()
{
  $professors = Professeur::with('groupes','matiere')->get();

    return response()->json($professors);
}

public function getById($userId)
{
    $professeur = Professeur::with('groupes', 'matiere','groupes.eleves.user','groupes.eleves.eleve_exams.note','groupes.eleves.eleve_exams.matire')->where('user_id', $userId)->first();

    if (!$professeur) {
        return response()->json(['error' => 'Professeur not found'], 404);
    }

    return response()->json($professeur);
}

public function getByIdlastcarnetBYgroupe($userId)
{
    $professeur = Professeur::with(['carnetNotes', 'groupes'])
        ->where('user_id', $userId)
        ->first();

    if (!$professeur) {
        return response()->json(['error' => 'Professor not found'], 404);
    }

    $lastNotes = [];

    foreach ($professeur->groupes as $groupe) {
        $lastNote = $groupe->carnetNotes()
            ->orderByDesc('created_at')
            ->first();

        if ($lastNote) {
            $lastNotes[$groupe->id] = [
                'groupe' => $groupe,
                'lastNote' => $lastNote,
            ];
        }
    }

    return response()->json($lastNotes);
}

public function store(Request $request)
  {
    $validatedData = $request->validate([
      'CNI' => 'required|string|unique:professeurs,CNI',
      'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
      'diplom' => 'required',
      'tel' => 'required',
      'user_id' => 'required',
    ]);

    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoName = time() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('photos'), $photoName);

        $validatedData['photo'] = $photoName;
    }
    $professeur = Professeur::create($validatedData);

    return response()->json(['professeur_id' => $professeur->id]);
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


// public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'prenom' => 'required',
//         'nom' => 'required',
//         'date_naissance' => 'required',
//         'lieu_naissance' => 'required',
//         'tel' => 'required',
//         'diplom' => 'required',
//         'address' => 'required',
//         'sex' => 'required',
//         'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//         'virement_id' => 'required',
//     ]);
//     if ($request->hasFile('photo')) {
//         $photo = $request->file('photo');
//         $photoName = time() . '.' . $photo->getClientOriginalExtension();
//         $photo->move(public_path('photos'), $photoName);

//         $validatedData['photo'] = $photoName;
//     }

//     $professuer = Professeur::create($validatedData);

//     // $professuer = Professuer::create($validatedData);

//     return response()->json(['professuer_id' => $professuer->id]);
// }







}
