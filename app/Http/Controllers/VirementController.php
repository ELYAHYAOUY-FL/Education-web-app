<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Virement;

class VirementController extends Controller
{
    public function index()
    {
        $virement = Virement::all();

        return response()->json($virement);
            
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'salaire' => 'required',
            // 'est_paye' => 'required',
            'rib' => 'required',
            // 'date' => 'required',
        ]);

        $virement = Virement::create($validatedData);

        return response()->json(['virement_id' => $virement->id]);
    }
}

