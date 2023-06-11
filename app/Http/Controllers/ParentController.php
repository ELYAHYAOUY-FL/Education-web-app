<?php

namespace App\Http\Controllers;
use App\Models\Eleve;
use App\Models\Parente  ;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Models\Bankinformation_Parent;
// use App\Models\Parent;
use App\Models\EleveParent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ParentController extends Controller
{
   
    // public function index()
    // {
    //     $parents = Parente::with('eleves')->get();

    //     return response()->json($parents);
    // }


    public function index()
    {
        $parents = Parente::with('eleves','user')->get();

        return response()->json($parents);
    }

    public function getById($userId)
    {
        $parents= Parente::with('eleves.eleve_exams.note', 'eleves.eleve_exams.matire','eleves.groupe','user', 'eleves.groupe.matieres.exams.note','eleves.groupe.emploiTemp','eleves.eleve_exams.note')->where('user_id', $userId)->first();
    
        if (!$parents) {
            return response()->json(['error' => 'elevesnot found'], 404);
        }
    
        return response()->json($eleves);
    }

    // public function showparent()
    // {
    //     $user =Auth::user();
    //     // dd($user);
    //     $parent=$user->parent();
    //     $eleves= $parent->eleves();
    //     // $ = Parente::with('eleves','user')->get();

    
    //     return response()->json([$user,$parent,$eleves]);
    // }


   




    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'CNI' => 'required|string|unique:parents,CNI',
    //         'tel' => 'required',
    //         'user_id' => 'required',
    //     ]);

    //     $parent = Parente::create($validatedData);
    //     return response()->json(['parent_id' => $parent->id]);
    // }

    public function store(Request $request)
{
    $validatedDatauser = $request->validate([
        'nom_francais' => 'required|string',
        'nom_arabe' => 'required|string',
        'prenom_francais' => 'required|string',
        'prenom_arabe' => 'required|string',
        'date_naissance' => 'required|date',
        'lieu_naissance' => 'required|string',
        'sex' => 'required|string',
        'email' => 'required|string',
        'password' => 'required|string',
        'username' => 'required|string',
        'user_type' => 'required|string',
        'adresse' => 'required|string',
    ]);
    $validatedDatauser['password'] = Hash::make($validatedDatauser['password']);

    $user = User::create($validatedDatauser);

    $validatedData = $request->validate([
        'CNI' => 'required|string',
        'tel' => 'required',
    ]);
    $parent= new Parente($validatedData);
    $parent->user()->associate($user);
    $parent->save();
     $eleves = $request->input('eleve_ids', []);
    $parent->eleves()->attach($eleves);

    $validatedDataProfessorInfoBank = $request->validate([
    
     
        'numero_compte' => 'required',
            'type_bank' => 'required',
        ]);

        $bankinfo = new Bankinformation_Parent($validatedDataProfessorInfoBank);
        $bankinfo->parent()->associate($parent);
        $bankinfo->save();
    return response()->json(['professeur_id' => $user->id]);
}
// public function getStudents($parentId)
// {
//     $parent = Parente::findOrFail($parentId);
//     $students = $parent->eleves;
//     return response()->json($students);
// }


// public function getCurrentParent()
// {
//     $user = auth()->user(); // Récupérez l'utilisateur actuellement authentifié

//     if ($user && $user instanceof Parente) {
//         $parentId = $user->id;
//         return response()->json(['id' => $parentId]);
//     }

//     return response()->json(['message' => 'Unauthorized'], 401);
// }

    
    // public function create(Request $request)
    // {
    //     $parent = Parent::create($request->all());

    //     if ($parent) {
    //         $eleve = Eleve::find($request->eleve_id);
    //         $eleve->parents()->attach($parent->id);

    //         return response()->json(['parent_id' => $parent->id], 200);
    //     }

    //     return response()->json(['error' => 'Failed to create parent'], 500);
    // }
//     public function associateEleve(Request $request, $parentId)
// {
//     $parent = Parent::find($parentId);
    
//     if (!$parent) {
//         return response()->json(['error' => 'Parent not found'], 404);
//     }
    
//     $eleveId = $request->input('eleve_id');
    
//     $parent->eleves()->attach($eleveId);
    
//     return response()->json(['message' => 'Parent and eleve associated successfully'], 200);
// }

     

}
