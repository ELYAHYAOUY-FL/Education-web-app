<?php

namespace App\Http\Controllers;

use App\Models\Devoir;
use Illuminate\Http\Request;

/**
 * Class DevoirController
 * @package App\Http\Controllers
 */
class DevoirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devoirs = Devoir::paginate();

        return view('devoir.index', compact('devoirs'))
            ->with('i', (request()->input('page', 1) - 1) * $devoirs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $devoir = new Devoir();
        return view('devoir.create', compact('devoir'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Devoir::$rules);

        $devoir = Devoir::create($request->all());

        return redirect()->route('devoirs.index')
            ->with('success', 'Devoir created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $devoir = Devoir::find($id);

        return view('devoir.show', compact('devoir'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $devoir = Devoir::find($id);

        return view('devoir.edit', compact('devoir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Devoir $devoir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devoir $devoir)
    {
        request()->validate(Devoir::$rules);

        $devoir->update($request->all());

        return redirect()->route('devoirs.index')
            ->with('success', 'Devoir updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $devoir = Devoir::find($id)->delete();

        return redirect()->route('devoirs.index')
            ->with('success', 'Devoir deleted successfully');
    }
}
