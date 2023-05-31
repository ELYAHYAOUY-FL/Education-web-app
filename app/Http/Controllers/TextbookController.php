<?php

namespace App\Http\Controllers;

use App\Models\Textbook;
use Illuminate\Http\Request;

class TextbookController extends Controller
{
    public function index()
    {
        $textbooks = Textbook::all();
        return response()->json($textbooks);
    }
    public function show(Textbook $textbook)
    {
        return response()->json($textbook);
    }
    public function gettextbookbyidprof($PorfId)
    {

        $text = Textbook::with('professeur')->where('professeur_id', $PorfId)->get();
        
        return response()->json($text);
       
    }


    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required',
    //         'description' => 'nullable',
    //         'date' => 'required',
    //         'heure' => 'required',
    //     ]);

    //     $textbook =  new Textbook;
      
    //      $textbook->title = $validatedData['title'];
    //      $textbook->description = $validatedData['description'];
    //      $textbook->date = $validatedData['date'];
    //      $textbook->heure = $validatedData['heure'];
       
    //      $textbook->save();
    //     // Vous pouvez ajouter d'autres logiques de traitement ici si nécessaire

    //     return response()->json(['message' =>  'Le cahier de texte a été créé avec succès.']);
    // }
   

    // public function update(Request $request, Textbook $textbook)
    // {
    //     // Validation des données entrées
    //     $validatedData = $request->validate([
    //         'title' => 'required',
    //         'description' => 'nullable',
    //         'date' => 'required',
    //         'heure' => 'required',
    //     ]);

    //     // Mise à jour des données du textbook
    //     $textbook->update($validatedData);

    //     return $textbook;
    // }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'date' => 'required',
            'heure' => 'required',
            'professeur_id' => 'required',

        ]);

        $textbook = Textbook::create($validatedData);
        return response()->json($textbook, 201);
    }

    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required',
    //         'description' => 'nullable',
    //         'date' => 'required',
    //         'heure' => 'required',
    //     ]);

    //     $textbook = Textbook::findOrFail($id);
    //     $textbook->update($validatedData);
    //     return response()->json($textbook, 200);
    // }
    public function update(Request $request, $id)
    {
        try {
            $textbook = Textbook::findOrFail($id);

            // Récupérer les champs à mettre à jour depuis la requête
            $textbook->title = $request->input('title');
            $textbook->description = $request->input('description');
            $textbook->date = $request->input('date');
            $textbook->heure = $request->input('heure');

            $textbook->save();

            return response()->json($textbook);
        } catch (\Exception $e) {
            // Gérer l'erreur lors de la mise à jour du cahier de texte
            return response()->json(['message' => 'Une erreur est survenue lors de la mise à jour du cahier de texte'], 500);
        }
    }

    // ...

    public function destroy($id)
    {
      
        // Suppression du textbook de la base de données
        $textbook = Textbook::findOrFail($id);
        $textbook->delete();

        return response()->json(['message' => 'Textbook deleted successfully']);
    }
}
