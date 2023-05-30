<?php

namespace App\Http\Controllers;

use App\Models\EmploiTemp;
use App\Models\Matiere;
use App\Models\Groupe;
use Illuminate\Http\Request;

class EmploiTempController extends Controller
{
    // public function index()
    // {
    //     $emplois = EmploiTemp::with('matiere', 'groupe')->get();
    //     return response()->json($emplois);
    // }
 

    public function getSchedulesByGroup(Request $request)
    {
        $groupId = $request->input('groupe_id');
        $group = Groupe::find($groupId);

        if (!$group) {
            return response()->json(['error' => 'Group not found'], 404);
        }

        $schedules =EmploiTemp::where('groupe_id', $groupId)->get();

        // Charger les détails de la matière pour chaque emploi du temps
        foreach ($schedules as $schedule) {
            $matiere = Matiere::find($schedule->matiere_id);
            $schedule->matiere_titre = $matiere ? $matiere->titre : 'N/A';
        }

        return response()->json($schedules);
    }
    public function getEmplois($EmploiId)
    {
        // $groupeId = $request->query('groupe_id');
        
        $emplois = EmploiTemp::with('matiere')->where('groupe_id', $EmploiId)->get();
        
        return response()->json($emplois);
    }
    public function getEmploiProf(Request $request)
    {
        $matiereId = $request->query('matiere_id');
        
        $emplois = EmploiTemp::with('groupe')->where('matiere_id', $matiereId)->get();
        
        return response()->json($emplois);
    }
    public function store(Request $request)
{
    // Validation des données reçues depuis le formulaire
    $validatedData = $request->validate([
        'jour' => 'required',
        'heure_debut' => 'required',
         
        'matiere_id' => 'required',
        'groupe_id' => 'required',
    ]);

    // Création de l'emploi du temps
    $emploi = EmploiTemp::create($validatedData);

    return response()->json(['emploi_id' => $emploi->id]);
}


    public function show($id)
    {
        $emploi = EmploiTemp::with('matiere', 'groupe')->findOrFail($id);
        return response()->json($emploi);
    }

    public function update(Request $request, $id)
    {
        $emploi = EmploiTemp::findOrFail($id);

        // Validation des données reçues depuis le formulaire
        $request->validate([
            'jour' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'matiere_id' => 'required|exists:matieres,id',
            'groupe_id' => 'required|exists:groupes,id',
        ]);

        // Mise à jour des données de l'emploi du temps
        $emploi->update($request->all());

        return response()->json($emploi, 200);
    }

    public function destroy($id)
    {
        $emploi = EmploiTemp::findOrFail($id);
        $emploi->delete();
        return response()->json(null, 204);
    }
}
