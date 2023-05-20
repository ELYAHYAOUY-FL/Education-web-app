<?php

namespace App\Http\Controllers;

  use App\Models\ClasseMatiere;
use Illuminate\Http\Request;

/**
 * Class ClasseMatiereController
 * @package App\Http\Controllers
 */
class ClasseMatiereController extends Controller
{
//     public function index()
// {
//     $classeMatiere = ClasseMatiere::find(1);
//     $classe = $classeMatiere->classe; // Access the related Classe model
//     $matiere = $classeMatiere->matiere; // Access the related Matiere model
//     $classeMatieres = ClasseMatiere::with("matiere", "classe")->get(); 
//     // Rest of your code

//     return response()->json($classeMatieres);
// }
public function index()
{
    $classeMatieres = ClasseMatiere::with("matiere", "classe")->get();
    return response()->json($classeMatieres);
}
  

    // public function index()
    // {
    //     $classeMatieres = ClasseMatiere::with("matiere", "classe")->get();
    //     return response()->json($classeMatieres);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classeMatiere = new ClasseMatiere();
        return view('classe-matiere.create', compact('classeMatiere'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ClasseMatiere::$rules);

        $classeMatiere = ClasseMatiere::create($request->all());

        return redirect()->route('classe-matieres.index')
            ->with('success', 'ClasseMatiere created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classeMatiere = ClasseMatiere::find($id);

        return view('classe-matiere.show', compact('classeMatiere'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classeMatiere = ClasseMatiere::find($id);

        return view('classe-matiere.edit', compact('classeMatiere'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ClasseMatiere $classeMatiere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClasseMatiere $classeMatiere)
    {
        request()->validate(ClasseMatiere::$rules);

        $classeMatiere->update($request->all());

        return redirect()->route('classe-matieres.index')
            ->with('success', 'ClasseMatiere updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $classeMatiere = ClasseMatiere::find($id)->delete();

        return redirect()->route('classe-matieres.index')
            ->with('success', 'ClasseMatiere deleted successfully');
    }
}
