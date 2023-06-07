<?php

namespace App\Http\Controllers;
use App\Models\Eleve;
use App\Models\Parente  ;
// use App\Models\Parent;
use App\Models\EleveParent;

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
    $parent = Parente::with('eleves')->where('user_id', $userId)->first();

    if (!$parent) {
        return response()->json(['error' => 'parents not found'], 404);
    }
     return response()->json($parent);
}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'CNI' => 'required|string|unique:parents,CNI',
            'tel' => 'required',
            'user_id' => 'required',
        ]);

        $parent = Parente::create($validatedData);
        return response()->json(['parent_id' => $parent->id]);
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
