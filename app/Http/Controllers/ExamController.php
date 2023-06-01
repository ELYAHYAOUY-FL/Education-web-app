<?php

namespace App\Http\Controllers;
use App\Models\Exam;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    //
    public function store(Request $request)
    {
      $validatedData = $request->validate([
       
      
        'date' => 'required',
		
		'nom'  => 'required',
		'matiere_id'  => 'required',
		'note_id' => 'required',
       
      ]);
  
      $exams = Exam::create($validatedData);
  
      return response()->json( $exams->id);
    }
}
