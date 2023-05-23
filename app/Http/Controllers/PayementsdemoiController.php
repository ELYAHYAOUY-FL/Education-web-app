<?php

namespace App\Http\Controllers;

use App\Models\Payementsdemoi;
use Illuminate\Http\Request;

class PayementsdemoiController extends Controller
{
    public function index()
    {
        $payement = Payementsdemoi::all();

        return response()->json($payement);
            
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'frais' => 'required',
            // 'est_paye' => 'required',
            'nom_compte' => 'required',
            // 'date' => 'required',
        ]);

        $payement = Payementsdemoi::create($validatedData);

        return response()->json(['payement_id' => $payement->id]);
    }
}
