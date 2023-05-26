<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use Illuminate\Http\Request;

/**
 * Class ClassController
 * @package App\Http\Controllers
 */
class ClassController extends Controller
{
    // public function index()
    // {
    //     $classes = Groupe::with("niveau_scolaire_id","emploi_id")->get();
    //     return response()->json($classes);

        
    // }
    public function index()
    {
        $classes = Groupe::with("niveau_scolaire", "emploi_temp")->get();
        return response()->json($classes);
    }
    

    
    public function create()
    {
        $class = new Groupe();
        return view('class.create', compact('class'));
    }

    
    public function store(Request $request)
    {
        request()->validate(Groupe::$rules);

        $class = Groupe::create($request->all());

        return redirect()->route('classes.index')
            ->with('success', 'Class created successfully.');
    }

   
    public function show($id)
    {
        $class = Groupe::find($id);

        return view('class.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = Groupe::find($id);

        return view('class.edit', compact('class'));
    }

    public function update(Request $request, Groupe $class)
    {
        request()->validate(Groupe::$rules);

        $class->update($request->all());

        return redirect()->route('classes.index')
            ->with('success', 'Class updated successfully');
    }

    public function destroy($id)
    {
        $class = Groupe::find($id)->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Class deleted successfully');
    }
}
