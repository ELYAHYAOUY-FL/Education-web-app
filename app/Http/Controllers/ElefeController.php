<?php

namespace App\Http\Controllers;

use App\Models\Elefe;
use Illuminate\Http\Request;

/**
 * Class ElefeController
 * @package App\Http\Controllers
 */
class ElefeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eleves = Elefe::paginate();

        return view('elefe.index', compact('eleves'))
            ->with('i', (request()->input('page', 1) - 1) * $eleves->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $elefe = new Elefe();
        return view('elefe.create', compact('elefe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Elefe::$rules);

        $elefe = Elefe::create($request->all());

        return redirect()->route('eleves.index')
            ->with('success', 'Elefe created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $elefe = Elefe::find($id);

        return view('elefe.show', compact('elefe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $elefe = Elefe::find($id);

        return view('elefe.edit', compact('elefe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Elefe $elefe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Elefe $elefe)
    {
        request()->validate(Elefe::$rules);

        $elefe->update($request->all());

        return redirect()->route('eleves.index')
            ->with('success', 'Elefe updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $elefe = Elefe::find($id)->delete();

        return redirect()->route('eleves.index')
            ->with('success', 'Elefe deleted successfully');
    }
}
