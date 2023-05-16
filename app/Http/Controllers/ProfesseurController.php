<?php

namespace App\Http\Controllers;
use App\Models\Professeur;

use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
 
    
    public function index()
    {
        $professeurs = Professeur::with('virement', 'matieres')->get();

        return response()->json($professeurs);
    }

}
