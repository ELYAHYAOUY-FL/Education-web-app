<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoursDevoirsController extends Controller
{
 
    //
    public function index()
    {
        $cour = Cours::all();
        return response()->json($cour);
    }
    public function create($PorfId)
    {
        $PorfId = Professeur::with('groupes.eleves')->findOrFail($PorfId);

        return view('cours.create', compact('professeur'));
    }

    public function getcoursbyidprof($PorfId)
    {

        $cour =Cours::with('professeur', 'groupe')->where('professeur_id', $PorfId)->get();
        
        return response()->json($cour);
       
    }
    public function getcoursbyidgroupe($groupeId)
    {

        $cour =Cours::with('professeur.user')->where('groupe_id', $groupeId)->get();
        
        return response()->json($cour);
       
    }

    public function telechargerFichier($id, $nomFichier)
    {
        $cours = Cours::find($id);
        if (!$cours) {
            return response()->json(['message' => 'Cours non trouvé'], 404);
        }
    
        $fichierChemin = storage_path('app/public/' . $cours->fichier);
    
        return response()->download($fichierChemin, $nomFichier);
    }
    

     /**
     * Summary of store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function store(Request $request)
{
    $validatedData = $request->validate([
        'titre' => 'required',
        'contenu' => 'required',
        'groupe_id' => 'required',
        'fichier' => 'required|file|max:5000|mimes:pdf,docx,ppt,pptx',
        'professeur_id' => 'required',
    ]);

    // Récupérer le fichier envoyé dans la requête
    $fichier = $request->file('fichier');

    // Obtenir le contenu du fichier en binaire
    $fichierContenu = file_get_contents($fichier->getRealPath());

    // Stocker le fichier dans le système de fichiers
    $fichierNom = $fichier->getClientOriginalName();
    Storage::disk('public')->put($fichierNom, $fichierContenu);

    // Mettre à jour les données validées avec le nom du fichier
    $validatedData['fichier'] = $fichierNom;

    // Créer le nouveau cours avec les données validées
    $cour = Cours::create($validatedData);

    return response()->json($cour, 201);
}
}

