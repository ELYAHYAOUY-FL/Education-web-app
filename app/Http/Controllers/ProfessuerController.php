<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\NiveauScolaire;
use App\Models\Professeur;

class ProfessuerController extends Controller
{
    //
    public function index(){
        // return Professeur::all();
        $professeurs= Professeur::with("niveau_scolaire")->get();
        return response()->json($professeurs);  
    }

    public function destroy($id)
    {
        $professeur = Professeur::findOrFail($id);
        $professeur->delete();
    
        // Optionally, you can return a response or redirect to a different page
        return response()->json(['message' => 'Professor deleted successfully']);
    }


    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'age' => 'required|numeric',
            'email' => 'required|email',
            'diplome' => 'required',
            'salaire' => 'required|numeric',
            'address' => 'required',
            'niveau_scolaire' => 'required',
            'photo' => 'required|image',
            'phone_number' => 'required',
        ]);
    
        if ($request->hasFile('photo')) {
            // Store the uploaded photo and retrieve its path
            $photoPath = $request->file('photo')->store('professor_photos', 'public');
        } else {
            return response()->json(['errors' => ['photo' => ['The photo field is required']]], 422);
        }
    
        // Create the professor using the validated data
        $professor = Professeur::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'age' => $validatedData['age'],
            'email' => $validatedData['email'],
            'diplome' => $validatedData['diplome'],
            'salaire' => $validatedData['salaire'],
            'address' => $validatedData['address'],
            'niveau_scolaire' => $validatedData['niveau_scolaire'],
            'photo' => $photoPath,
            'phone_number' => $validatedData['phone_number'],
        ]);
        
    
        return response()->json(['message' => 'Professor created successfully']);
    }
    

}
