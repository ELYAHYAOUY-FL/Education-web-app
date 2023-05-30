<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use Illuminate\Http\Request;

class GroupeController extends Controller
{
    public function index()
    {
        $groupe = Groupe::all();
        return response()->json($groupe);
    }
    public function show($groupeId)
    {
        $groupe = Groupe::findOrFail($groupeId);
        return response()->json($groupe);
    }
}
