<?php

namespace App\Http\Controllers;
use App\Models\Professeur;

use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
 
    
    // public function index()
    // {
    //     $professeurs = Professeur::with('virement', 'matieres')->get();

    //     return response()->json($professeurs);
    // }
//     public function index()
// {
//     $professeurs = Professeur::with('virement', 'matieres.classe')->get();

//     // $professeurs = Professeur::with('virement', 'matieres')->get();
//     // $professeurs = Professeur::with('virement', 'matieres.classe_matiere.classe')->get();

//     return response()->json($professeurs);
// }
// public function index()
// {
//     $professeurs = Professeur::with('virement', 'matieres','matieres.classe_matiere')->get();
//     return response()->json($professeurs);
// }
public function index()
{
    $professors = Professeur::with('virement', 'matieres', 'matieres.classes')->get();

    return response()->json($professors);
}





}
