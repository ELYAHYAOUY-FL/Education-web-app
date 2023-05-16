<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use Illuminate\Http\Request;

/**
 * Class AnneeScolaireController
 * @package App\Http\Controllers
 */
class AnneeScolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anneeScolaires = AnneeScolaire::paginate();

        return view('annee-scolaire.index', compact('anneeScolaires'))
            ->with('i', (request()->input('page', 1) - 1) * $anneeScolaires->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anneeScolaire = new AnneeScolaire();
        return view('annee-scolaire.create', compact('anneeScolaire'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(AnneeScolaire::$rules);

        $anneeScolaire = AnneeScolaire::create($request->all());

        return redirect()->route('annee-scolaires.index')
            ->with('success', 'AnneeScolaire created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anneeScolaire = AnneeScolaire::find($id);

        return view('annee-scolaire.show', compact('anneeScolaire'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anneeScolaire = AnneeScolaire::find($id);

        return view('annee-scolaire.edit', compact('anneeScolaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AnneeScolaire $anneeScolaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnneeScolaire $anneeScolaire)
    {
        request()->validate(AnneeScolaire::$rules);

        $anneeScolaire->update($request->all());

        return redirect()->route('annee-scolaires.index')
            ->with('success', 'AnneeScolaire updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $anneeScolaire = AnneeScolaire::find($id)->delete();

        return redirect()->route('annee-scolaires.index')
            ->with('success', 'AnneeScolaire deleted successfully');
    }
}
