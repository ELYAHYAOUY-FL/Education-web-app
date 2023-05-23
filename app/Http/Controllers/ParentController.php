<?php

namespace App\Http\Controllers;
use App\Models\Eleve;
use App\Models\Parente  ;

use Illuminate\Http\Request;

class ParentController extends Controller
{
    // public function index()
    // {
    //     $parents = Parent::with('payementdemois')->get();
    //     return response()->json($parents);
    // }
    public function index()
    {
        $parents = Parente::with('eleves')->get();

        return response()->json($parents);
    }
    public function create()
    {
        $eleves = Eleve::all(); // Récupérer tous les élèves

        return view('parents.create', compact('eleves'));
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
            'virement_id' => 'required',
        ]);
         
    
        $parent = Parente::create($validatedData);
        $eleves = $request->input('eleves'); // IDs des élèves sélectionnés dans le formulaire
        $parent->eleves()->attach($eleves);
        // $professuer = Professuer::create($validatedData);
    
        return response()->json(['parent_id' => $parent->id]);
    }
    
     

}
