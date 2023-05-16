<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

/**
 * Class ClassController
 * @package App\Http\Controllers
 */
class ClassController extends Controller
{
    public function index()
    {
        $classes = Classe::with("niveau_scolaire_id","emploi_id")->get();
        return response()->json($classes);

        
    }

    
    public function create()
    {
        $class = new Classe();
        return view('class.create', compact('class'));
    }

    
    public function store(Request $request)
    {
        request()->validate(Classe::$rules);

        $class = Classe::create($request->all());

        return redirect()->route('classes.index')
            ->with('success', 'Class created successfully.');
    }

   
    public function show($id)
    {
        $class = Classe::find($id);

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
        $class = Classe::find($id);

        return view('class.edit', compact('class'));
    }

    public function update(Request $request, Classe $class)
    {
        request()->validate(Classe::$rules);

        $class->update($request->all());

        return redirect()->route('classes.index')
            ->with('success', 'Class updated successfully');
    }

    public function destroy($id)
    {
        $class = Classe::find($id)->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Class deleted successfully');
    }
}
