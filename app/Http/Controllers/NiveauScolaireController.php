<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\NiveauScolaire;

class NiveauScolaireController extends Controller
{
 public function index(){
  //  return inertia("NiveauScolaire/Index");
   return NiveauScolaire::all();
 }
 public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
        ]);

        $niveauScolaire = new NiveauScolaire;
        $niveauScolaire->nom = $validatedData['nom'];
        // Set other properties of NiveauScolaire if needed

        $niveauScolaire->save();

        // Optionally, you can return a response or redirect to a different page
        return response()->json(['message' => 'NiveauScolaire added successfully']);
    }
    public function destroy($id)
    {
        $niveauScolaire = NiveauScolaire::findOrFail($id);
        $niveauScolaire->delete();

        // Optionally, you can return a response or redirect to a different page
        return response()->json(['message' => 'NiveauScolaire deleted successfully']);
    }
    public function update(Request $request, $id)
    {
        // Find the niveau scolaire with the specified id
        $niveauScolaire = NiveauScolaire::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        // Update the niveau scolaire with the validated data
        $niveauScolaire->update($validatedData);

        // Return a response indicating success
        return response()->json(['message' => 'Niveau scolaire updated successfully']);
    }

}
