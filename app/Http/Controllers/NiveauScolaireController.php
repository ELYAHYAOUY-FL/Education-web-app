<?php

namespace App\Http\Controllers;

use App\Models\NiveauScolaire;
use Illuminate\Http\Request;

/**
 * Class NiveauScolaireController
 * @package App\Http\Controllers
 */
class NiveauScolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveauScolaires = NiveauScolaire::with('groupes','groupes.eleves.user')->get();

        return response()->json($niveauScolaires);
            
    }

   

    public function create()
    {
        $niveauScolaire = new NiveauScolaire();
        
    }

   
   
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nom' => 'required',
        'description' => 'required',
        'année_scolaire' => 'required',
    ]);

    $niveau_scolaire = new NiveauScolaire;
    $niveau_scolaire->nom = $validatedData['nom'];
    $niveau_scolaire->description = $validatedData['description'];
    $niveau_scolaire->année_scolaire = $validatedData['année_scolaire'];

    $niveau_scolaire->save();

    return response()->json(['message' => 'Le niveau a été ajouté avec succès']);
}

   
    public function update(Request $request, $id)
    {
       
    // Find the niveau scolaire with the specified id
    $niveauScolaire = NiveauScolaire::findOrFail($id);

    // Validate the incoming request data
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'required',
        'année_scolaire' => 'required',
    ]);

    // Update the specific fields of niveau scolaire with the validated data
    $niveauScolaire->nom = $validatedData['nom'];
    $niveauScolaire->description = $validatedData['description'];
    $niveauScolaire->année_scolaire = $validatedData['année_scolaire'];
    $niveauScolaire->save();

    // Return a response indicating success
    return response()->json(['message' => 'Niveau scolaire updated successfully']);


    } 
    

   
    public function destroy($id)
    {
        $niveauScolaire = NiveauScolaire::findOrFail($id);
        $niveauScolaire->delete();

        // Optionally, you can return a response or redirect to a different page
        return response()->json(['message' => 'NiveauScolaire deleted successfully']);
    }
}
