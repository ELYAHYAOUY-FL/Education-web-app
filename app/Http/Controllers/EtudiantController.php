<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\NiveauScolaire;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtudiantController extends Controller
{
    public function index(){
        $etudiants = Etudiant::with("niveau_scolaire")->get();
        return response()->json($etudiants);  
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'age' => 'required|integer',
            'date_naissance' => 'required|date',
            'sexe' => 'required|in:M,F',
            'niveau_scolaire' => 'required|exists:niveau_scolaires,id',
            'photo' => 'nullable|image|max:2048',
        ]);
try{
  DB::beginTransaction();
  // $etudiant = new Etudiant;
  // $etudiant->nom = $validatedData['nom'];
  // $etudiant->prenom = $validatedData['prenom'];
  // $etudiant->age = $validatedData['age'];
  // $etudiant->date_naissance = $validatedData['date_naissance'];
  // $etudiant->sexe = $validatedData['sexe'];
  // $etudiant->niveau_scolaire_id = $validatedData['niveau_scolaire'];
  $etudiant = Etudiant::create([...$validatedData,  "niveau_scolaire-id" => $request->niveau_scolaire]);

  if ($request->hasFile("photo")) {
       $photo = $request->photo;
       $fileName = $photo->getClientOriginalName();
      $photoPath = $photo-> storeAs("photos" , $fileName, "public" );
      $etudiant->photo = $photoPath;
      $etudiant->save();
  }
  DB::coomit();
}

  catch(Exception $e){
    DB::rollBack();

  }     

       

        return redirect()->back();
    }


      public function  create(){
        $niveauScolaires = NiveauScolaire::all(); 
        return inertia("Etudiant/Create", [
          "niveauScolaires" => $niveauScolaires,
        ] );
        }}

