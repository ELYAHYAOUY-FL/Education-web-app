<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VirementController extends Controller
{
    public function index()
    {
        $virement = Virement::all();

        return response()->json($virement);
            
    }
}
