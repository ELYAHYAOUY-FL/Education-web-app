<?php

namespace App\Http\Controllers;
use App\Models\Eleve;
use App\Models\Parente  ;

use Illuminate\Http\Request;

class ParentController extends Controller
{
   
    public function index()
    {
        $parents = Parente::with('eleves')->get();

        return response()->json($parents);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'CNI' => 'required|string|unique:parents,CNI',
            'tel' => 'required',
            'user_id' => 'required',
        ]);
         
    
        $parent = Parente::create($validatedData);
      
    
        return response()->json(['parent_id' => $parent->id]);
    }
    
     

}
