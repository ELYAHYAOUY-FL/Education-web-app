<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\NiveauScolaire;
use App\Models\Professeur;

class ProfessuerController extends Controller
{
    //
    public function index(){
        // return Professeur::all();
        $professeurs= Professeur::with("niveau_scolaire")->get();
        return response()->json($professeurs);  
    }
}
