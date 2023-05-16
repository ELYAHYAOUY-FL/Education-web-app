<?php

namespace App\Http\Controllers;

use App\Models\AnneNiveau;
use Illuminate\Http\Request;

/**
 * Class AnneNiveauController
 * @package App\Http\Controllers
 */
class AnneNiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anneNiveaus = AnneNiveau::paginate();

        return view('anne-niveau.index', compact('anneNiveaus'))
            ->with('i', (request()->input('page', 1) - 1) * $anneNiveaus->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anneNiveau = new AnneNiveau();
        return view('anne-niveau.create', compact('anneNiveau'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(AnneNiveau::$rules);

        $anneNiveau = AnneNiveau::create($request->all());

        return redirect()->route('anne-niveaus.index')
            ->with('success', 'AnneNiveau created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anneNiveau = AnneNiveau::find($id);

        return view('anne-niveau.show', compact('anneNiveau'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anneNiveau = AnneNiveau::find($id);

        return view('anne-niveau.edit', compact('anneNiveau'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AnneNiveau $anneNiveau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnneNiveau $anneNiveau)
    {
        request()->validate(AnneNiveau::$rules);

        $anneNiveau->update($request->all());

        return redirect()->route('anne-niveaus.index')
            ->with('success', 'AnneNiveau updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $anneNiveau = AnneNiveau::find($id)->delete();

        return redirect()->route('anne-niveaus.index')
            ->with('success', 'AnneNiveau deleted successfully');
    }
}
