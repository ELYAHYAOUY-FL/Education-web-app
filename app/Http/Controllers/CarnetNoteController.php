<?php

namespace App\Http\Controllers;

use App\Models\CarnetNote;
use App\Models\Groupe;
use App\Models\Professeur;
use Illuminate\Http\Request;
use  Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class CarnetNoteController extends Controller
{

    public function index()
    {
        $note = CarnetNote::all();
        return response()->json($note);
    }
    public function getcarnetnotebyidprof($PorfId)
    {

        $note = CarnetNote::with('professeur', 'groupe')->where('professeur_id', $PorfId)->get();
        
        return response()->json($note);
       
    }
//     public function getCarnetNotes()
// {
//     $professeurId = auth()->user()->id;
//     $carnetNotes = CarnetNote::where('professeur_id', $professeurId)->get();

//     return response()->json($carnetNotes);
// }

    public function create($professeurId)
    {
        $professeur = Professeur::with('groupes.eleves')->findOrFail($professeurId);

        return view('carnetnotes.create', compact('professeur'));
    }


    // Méthode pour enregistrer une note dans le carnet
//    public function store(Request $request, $professeurId)
//     {
//         $professeur = Professeur::findOrFail($professeurId);

//         $carnetNote = new CarnetNote();
//         $carnetNote->date = $request->input('date');
//         $carnetNote->contenu = $request->input('contenu');

//         $professeur->carnetNotes()->save($carnetNote);

//         return response()->json([
//             'message' => 'Carnet de notes créé avec succès',
//             'carnetNote' => $carnetNote
//         ], 201);
//     }
public function store(Request $request)
{
    $validatedData = $request->validate([
        'contenu' => 'required',
        'professeur_id' => 'required',
        'groupe_id' => 'required',

    ]);

    $textbook = CarnetNote::create($validatedData);
    return response()->json($textbook, 201);
}
 
}
