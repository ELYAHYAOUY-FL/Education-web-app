<?php

namespace App\Http\Controllers;

use App\Models\Devoir;
use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    // public function index()
    // {
    //     $devoirs = Devoir::paginate();

    //     return view('devoir.index', compact('devoirs'))
    //         ->with('i', (request()->input('page', 1) - 1) * $devoirs->perPage());
    // }
    public function create($PorfId)
    {
        $PorfId = Professeur::with('groupes.eleves')->findOrFail($PorfId);

        return view('devoirs.create', compact('professeur'));
    }

    public function getcoursbyidprof($PorfId)
    {

        $cour =Devoir::with('professeur', 'groupe')->where('professeur_id', $PorfId)->get();
        
        return response()->json($cour);
       
    }
    public function telechargerFichier($id, $nomFichier)
    {
        // Récupérer le chemin complet du fichier
        $cheminVersFichier = 'public/' . $nomFichier;

    if (Storage::exists($cheminVersFichier)) {
        return response()->download(Storage::path($cheminVersFichier));
    } else {
        return response()->json(['message' => 'Le fichier demandé n\'existe pas.'], 404);
    }
    }
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'fichier' => 'required|file',
            'date_limite' => 'required|date',
            'professeur_id' => 'required|exists:professeurs,id',
            'groupe_id' => 'required|exists:groupes,id',
        ]);

        // Récupérer le fichier uploadé
        $fichier = $request->file('fichier');

        // Générer un nom unique pour le fichier
        $fichierNom = uniqid() . '.' . $fichier->getClientOriginalExtension();

        // Déplacer le fichier vers le dossier de destination
        $fichier->move(public_path('uploads'), $fichierNom);

        // Créer le devoir dans la base de données
        $devoir = new Devoir;
        $devoir->titre = $request->titre;
        $devoir->description = $request->description;
        $devoir->fichier = $fichierNom;
        $devoir->date_limite = $request->date_limite;
        $devoir->professeur_id = $request->professeur_id;
        $devoir->groupe_id = $request->groupe_id;
        $devoir->save();

        // Retourner une réponse réussie
        return response()->json(['message' => 'Devoir créé avec succès'], 201);
    }

    public function validerDevoir($id)
    {
        $devoir = Devoir::findOrFail($id);
        $devoir->valide = true;
        $devoir->save();

        return response()->json(['message' => 'Devoir validé avec succès'], 200);
    }
   
     
}
