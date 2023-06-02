<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;


class NoteController extends Controller
{
    //
    public function store(Request $request)
  {
    $validatedData = $request->validate([
     
      'valeur' => 'required',
     
    ]);

    $note = Note::create($validatedData);

    return response()->json($note);
  }
}
