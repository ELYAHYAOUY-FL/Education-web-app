<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Groupe;
use App\Models\Parente;
use App\Models\Bankinformation_Parent;
use App\Models\Professeur;
use Illuminate\Http\Request;

class EleveController extends Controller
{
    public function index()
    {
        $eleves = Eleve::with('groupe','user' , 'eleve_exams')->get();
        return response()->json($eleves);
    }
    public function show($id)
    {
        $eleves = Eleve::with('groupe','user' , 'eleve_exams')->where('id', $id)->first();
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


public function getLastCarentByProf($userId)
{
    $eleve = Eleve::with(['groupe.carnetNotes', 'eleve_professuers.professeur'])
        ->where('user_id', $userId)
        ->first();

    if (!$eleve) {
        return response()->json(['error' => 'eleve not found'], 404);
    }

    $lastNotes = [];
    foreach ($eleve->eleve_professuers as $eleveProfessuer) {
        $professeur = $eleveProfessuer->professeur;
        $groupe = $eleveProfessuer->groupe;
        $lastNote = $groupe->carnetNotes()
            ->orderByDesc('created_at')
            ->first();

        if ($lastNote) {
            $lastNotes[$professeur->id] = [
                'professeur' => $professeur,
                'lastNote' => $lastNote,
            ];
        }
    }

    return response()->json($lastNotes);
}

// public function getDevoir($eleveId){
//         $eleve=Eleve::findOrFail($eleveId);
//         $devoirs=$eleve->devoirs()->get();

//         // dd($devoirs);
//         return response()->json($devoirs);
// }

public function getDevoir($eleveId)
{
    $eleve = Eleve::findOrFail($eleveId);
    $devoirs = $eleve->devoirs()->with('professeur.user','professeur.matiere')->get();
    
    return response()->json($devoirs);
}


public function updateValidationDevoir($eleveId,$devoireid){
    $eleve=Eleve::findOrFail($eleveId);
   
  $eleve->devoirs()->updateExistingPivot($devoireid,['validation'=> true]);
  return response()->json(['message'=>'update succes']);
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

// public function getLastCarnetDeNoteByEleveAndGroupe($id, $groupeId)
// {
//     $eleve = Eleve::with(['groupe.professeurs.carnetNotes'])
//         ->where('user_id', $id)
//         ->where('groupe_id', $groupeId)
//         ->first();

//     if (!$eleve) {
//         return response()->json(['error' => 'Eleve not found'], 404);
//     }

//     $lastCarnets = [];

//     foreach ($eleve->groupe->professeurs as $professeur) {
//         $lastCarnet = $professeur->carnetNotes()
//             ->where('groupe_id', $groupeId)
//             ->orderByDesc('created_at')
//             ->first();

//         $lastCarnets[$professeur->id] = $lastCarnet;
//     }

//     return response()->json($lastCarnets);
// }



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

       $parentCheck = $request->input('parentcheck');
       
       if ($parentCheck == 1) {
           // Parent exists, attach parents to the student
           $parents = $request->input('parents_ids', []);
           $eleve->parents()->attach($parents);
   
    } elseif($parentCheck==0) {
           // Parent doesn't exist, create a new parent entry
           
       $validatedDatauser = $request->validate([
           'nom_francais_parent' => 'required|string',
           'nom_arabe_parent' => 'required|string',
           'prenom_francais_parent' => 'required|string',
           'prenom_arabe_parent' => 'required|string',
           'date_naissance_parent' => 'required|date',
           'lieu_naissance_parent' => 'required|string',
           'sex_parent' => 'required|string',
           'email_parent' => 'required|string',
           'password_parent' => 'required|string',
           'username_parent' => 'required|string',
           'user_type_parent' => 'required|string',
           'adresse_parent' => 'required|string',
       ]);
       // $validatepassword = Hash::make($validatedDatauser['password_parent']);

       
       $user = new User();
       $user->nom_francais = $validatedDatauser['nom_francais_parent'];
       $user->nom_arabe = $validatedDatauser['nom_arabe_parent'];
       $user->prenom_francais = $validatedDatauser['prenom_francais_parent'];
       $user->prenom_arabe = $validatedDatauser['prenom_arabe_parent'];
       $user->date_naissance = $validatedDatauser['date_naissance_parent'];
       $user->lieu_naissance = $validatedDatauser['lieu_naissance_parent'];
       $user->sex = $validatedDatauser['sex_parent'];
       $user->email = $validatedDatauser['email_parent'];
       $user->password = Hash::make($validatedDatauser['password_parent']); // Hash the password
       $user->username = $validatedDatauser['username_parent'];
       $user->user_type = $validatedDatauser['user_type_parent'];
       $user->adresse = $validatedDatauser['adresse_parent'];
       
       $user->save();

     $validatedDataParent = $request->validate([
       'CNI_parent' => 'required|string|unique:parents,CNI',
       'tel_parent' => 'required',
      
      ]);
           $parent = new Parente();
          $parent->CNI = $validatedDataParent['CNI_parent'];
               $parent->tel = $validatedDataParent['tel_parent'];
               $parent->user()->associate($user);
               $parent->save();
               $eleve->parents()->attach($parent->id);
               $validatedDataParentInfoBank = $request->validate([
                   'numero_compte' => 'required',
                  'type_bank' => 'required',
              ]);
              $bankinfo = new Bankinformation_Parent($validatedDataParentInfoBank);
              $bankinfo->parent()->associate($parent);
              $bankinfo->save();
      
       }
       

   
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
