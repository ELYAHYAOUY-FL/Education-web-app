<?php

namespace App\Http\Controllers;


use App\Models\Activity;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
 

class ActivityController extends Controller
{
    // public function index()
    // {
    //     $activities = Activity::all();

    //     $activitiesWithPhotoUrls = $activities->map(function ($activity) {
    //         $activity['photoUrl'] = Storage::url($activity['photo']);
    //         return $activity;
    //     });

    //     return response()->json($activitiesWithPhotoUrls);
    // }
    public function index()
    {
        $activities = Activity::select('nom','id', 'description', 'date', 'heure', 'photo')->get();
        return response()->json($activities);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'heure' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de la photo
        ]);
    
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('photos'), $photoName);
    
            $validatedData['photo'] = $photoName;
        }
    
        $activity = Activity::create($validatedData);
    
        return response()->json($activity, 201);
    }
    public function show($id)
    {
        $activite = Activity::find($id);
        return response()->json($activite);
    }

    public function update(Request $request, $id)
    {

        $activite = Activity::findOrFail($id);
        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'heure' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Modification optionnelle : autoriser la modification de la photo
        ]);
    
        $activite->nom = $validatedData['nom'];
        $activite->description = $validatedData['description'];
        $activite->date = $validatedData['date'];
        $activite->heure = $validatedData['heure'];
        
    
        // Gérez la mise à jour de l'image ici si nécessaire
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('photos', 'public');
            $activite->photo = $photoPath;
        };
        $validatedData = $request->validate(Activity::$rules);
        $activite->update($validatedData);

  // Mettre à jour les attributs de l'activité
 
        $activite->save();
        
    
        return response()->json(['message' => 'Activité mise à jour avec succès']);
    }
    
    // public function updatePartial(Request $request)
    // {
    //     if ($request->hasFile('photo')) {
    //         // Récupérer le fichier photo
    //         $photo = $request->file('photo');

    //         // Générer un nom unique pour la photo
    //         $filename = uniqid() . '.' . $photo->getClientOriginalExtension();

    //         // Définir le chemin de stockage de la photo
    //         $path = 'photos/' . $filename;

    //         // Enregistrer la photo sur le disque
    //         Storage::disk('public')->put($path, file_get_contents($photo));

    //         // Construire l'URL de la nouvelle photo
    //         $photoUrl = asset('storage/' . $path);

    //         // Retourner l'URL de la nouvelle photo
    //         return response()->json([
    //             'photoUrl' => $photoUrl,
    //         ]);
    //     }

    //     // Si aucune photo n'a été téléchargée, retourner une erreur
    //     return response()->json([
    //         'error' => 'Aucune photo n\'a été téléchargée.',
    //     ], 422);
    
    // }    
    
    // public function destroy($id)
    // {

    //     $activity = Activity::findOrFail($id);
    //     $activity->delete();

    //     // Optionally, you can return a response or redirect to a different page
    //     return response()->json(['message' => 'NiveauScolaire deleted successfully']);
    //     // Rechercher l'activité par ID
    //     // $activity = Activity::findOrFail($nom);

    //     // // Supprimer l'activité et sa photo associée
    //     // if ($activity->photo) {
    //     //     Storage::delete('public/photos/' . $activity->photo);
    //     // }

    //     // $activity->delete();

    //     // return response()->json(['message' => 'Activité supprimée avec succès']);
    // }
    public function destroy($id)
{
    $activity = Activity::findOrFail($id);
    $activity->delete();

    return response()->json(['message' => 'Activity deleted successfully']);
}


}

