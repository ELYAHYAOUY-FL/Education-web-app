<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Bankinformation_ProfController extends Controller
{
    //i
    public function index()
{
    $bankinformation_prof = Bankinformation_Prof::with('professeur')->get();

    return response()->json($bankinformation_prof);
}

public function store(Request $request)
{
  $validatedData = $request->validate([
    'professeur_id' => 'required',
    'rib' => 'required',
    'numero_compte' => 'required',
        'type_bank' => 'required',
    ]);

    $bankinfo = Bankinformation_Prof::create($validatedData);

    return response()->json(['bankinfo_id' => $bankinfo->id]);
  }


}
