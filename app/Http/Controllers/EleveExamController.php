<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EleveExames;

class EleveExamController extends Controller
{
    public function index()
    {
        $eleves =EleveExames ::all();
        return response()->json($eleves);
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'exame_id' => 'required',
            'eleve_id' => 'required',
        ]);

        $eleveExam = EleveExames::create($validatedData);

        return response()->json($eleveExam);
    }
}
