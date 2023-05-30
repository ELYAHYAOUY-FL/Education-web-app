<?php

namespace App\Http\Controllers;
use App\Models\Matiere;


use Illuminate\Http\Request;

class MatiereController extends Controller
{
    //
    // public function index()
    // {
    //     $matiers = Matiere::with("professeur")->get();

    //     return response()->json($matiers);
            
    // }
    public function index()
{
    $matieres = Matiere::with( 'groupes')->get();

    return response()->json($matieres);
}
}
