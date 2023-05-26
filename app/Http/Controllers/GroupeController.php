<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupe;

class GroupeController extends Controller
{
   
    
    public function index()
    {
        $groupes = Groupe::with('niveau_scolaire')->get();
        return response()->json($groupes);
    }
}
