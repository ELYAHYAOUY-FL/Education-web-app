<?php

namespace App\Http\Controllers;
use App\Models\Bankinformation_Prof;

use Illuminate\Http\Request;

class Bankinformation_ProfController extends Controller     
{
    //i
    public function index()
    {
        $bankinfoProfesseur = Bankinformation_Prof::with('professeur')->get();
        return response()->json($bankinfoProfesseur);
    }
    public function getBankInfoByProfesseurId($ProfesseurId)
    {
        $bankinfoProfesseur = Bankinformation_Prof::where('professeur_id', $ProfesseurId)->first();

        if ($bankinfoProfesseur) {
            return response()->json($bankinfoProfesseur->id);
        } else {
            return response()->json(['message' => 'Bank information not found'], 404);
        }
    }


}
