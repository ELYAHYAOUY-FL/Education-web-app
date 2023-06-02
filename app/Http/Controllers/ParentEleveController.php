<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EleveParent;


class ParentEleveController extends Controller
{
    public function index()
    {
        $eleves = EleveParent::all();
        return response()->json($eleves);
    }

    public function store(Request $request)
    {
        $request->validate([
            'eleve_ids' => 'required|array',
            'eleve_ids.*' => 'exists:eleves,id',
            'parent_id' => 'required|exists:parents,id',
        ]);

        $eleveIds = $request->input('eleve_ids');
        $parentId = $request->input('parent_id');

        try {
            foreach ($eleveIds as $eleveId) {
                $eleveParent = new EleveParent;
                $eleveParent->parent_id = $parentId;
                $eleveParent->eleve_id = $eleveId;
                $eleveParent->save();
            }

            return response()->json(['message' => 'Parents and élèves associated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to associate parents and élèves'], 500);
        }
    }
}
