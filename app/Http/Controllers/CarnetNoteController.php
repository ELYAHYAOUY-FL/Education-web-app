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
 
    public function getcarnetnotebyidgroupe($groupeId)
    {

        $note = CarnetNote::with('professeur.user')->where('groupe_id', $groupeId)->get();
        
        return response()->json($note);
       
    }
 

    public function create($professeurId)
    {
        $professeur = Professeur::with('groupes.eleves')->findOrFail($professeurId);

        return view('carnetnotes.create', compact('professeur'));
    }


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
