<?php

namespace App\Http\Controllers;

use App\Models\ProgrammeCantine;
use Illuminate\Http\Request;

class CantineController extends Controller
{

    public function ajouterMenu(Request $request)
{
    // Valider les données de la requête
    $validatedData = $request->validate([
        'menu' => 'required',
        'nom' => 'required',
    ]);

    // Créer une nouvelle instance de ProgrammeCantine
    $programmeCantine = new ProgrammeCantine();
    $programmeCantine->menu = $validatedData['menu'];
    $programmeCantine->nom = $validatedData['nom'];

    // Sauvegarder le menu dans la base de données
    $programmeCantine->save();

    // Récupérer tous les programmes existants depuis la base de données
    $menus = ProgrammeCantine::all();

    return response()->json(['menus' => $menus], 200);
}

// public function store(Request $request)
//     {
//         $validatedData = $request->validate([
//             'jour' => 'required',
//         'nom' => 'required',
//         ]);

//         $programmeCantine = new ProgrammeCantine();
//         $programmeCantine->jour = $validatedData['jour'];
//         $programmeCantine->nom = $validatedData['nom'];
//         // Set other properties of NiveauScolaire if needed

//         $programmeCantine->save();

//         // Optionally, you can return a response or redirect to a different page
//         return response()->json(['message' => 'cantine  added successfully']);
//     }

    public function getProgrammeSemaine()
    {
        $programmeSemaine = ProgrammeCantine::all();

        return response()->json($programmeSemaine);
    }

    public function getMenuJour($nom)
{
    $menu = ProgrammeCantine::where('nom', $nom)->value('menu');

    return response()->json(['menu' => $menu]);
}

public function updateMenuJour($nom)
{
    $nouveauMenu = request()->input('menu');

    $programmeCantine = ProgrammeCantine::where('nom', $nom)->first();
    $programmeCantine->menu = $nouveauMenu;
    $programmeCantine->save();

    return response()->json(['menu' => $nouveauMenu]);
}

public function supprimerJour($id)
{
    $jourSupprime = ProgrammeCantine::findOrFail($id);

    if ($jourSupprime) {
        $jourSupprime->delete();
        return response()->json(['message' => 'Le jour a été supprimé avec succès.']);
    } else {
        return response()->json(['message' => 'Le jour n\'existe pas.'], 404);
    }
}


}
