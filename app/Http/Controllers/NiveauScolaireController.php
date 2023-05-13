<?php

namespace App\Http\Controllers;
use App\Models\NiveauScolaire;
use Illuminate\Http\Request;

class NiveauScolaireController extends Controller
{
    public function index(){
        //  return inertia("NiveauScolaire/Index");
         return NiveauScolaire::all();
       }
       public function store(Request $request)
          {
              $validatedData = $request->validate([
                  'nom' => 'required',
              ]);
      
              $niveauScolaire = new NiveauScolaire;
              $niveauScolaire->nom = $validatedData['nom'];
              // Set other properties of NiveauScolaire if needed
      
              $niveauScolaire->save();
      
              // Optionally, you can return a response or redirect to a different page
              return response()->json(['message' => 'NiveauScolaire added successfully']);
          }
}
