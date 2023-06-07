<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupe;

class GroupeController extends Controller
{
   
    
    public function index()
    {
        $groupes = Groupe::with('niveau_scolaire','eleves' ,'eleves.user')->get();
        return response()->json($groupes);
    }
    public function getGroupStudents($groupId)
    {
        $group = Groupe::findOrFail($groupId);
        $students = $group->eleves()->with('user')->get();
        return response()->json($students);
    }
    
    public function addGroupe(Request $request, $niveauScolaireId)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'capacite' => 'required|integer',
            'salle' => 'required',
        ]);

        $groupe = new Groupe();
        $groupe->nom = $validatedData['nom'];
        $groupe->capacity = $validatedData['capacite'];
        $groupe->salle = $validatedData['salle'];
        $groupe->niveau_scolaire_id = $niveauScolaireId;
        $groupe->save();

        return response()->json(['message' => 'Groupe ajouté avec succès'], 201);
    }


  public function calculateGroupAverage($groupId, $examId)
{
    $group = Groupe::with(['eleves.eleve_exams' => function ($query) use ($examId) {
        $query->where('exam_id', $examId);
    }])->find($groupId);

    if (!$group) {
        return response()->json(['error' => 'Group not found'], 404);
    }

    $totalNotes = 0;
    $totalEleves = 0;

    foreach ($group->eleves as $eleve) {
        foreach ($eleve->eleve_exams as $eleveExam) {
            if ($eleveExam->exam_id == $examId && $eleveExam->note) {
                $totalNotes += $eleveExam->note->valeur;
                $totalEleves++;
                break; // Only consider the first exam of the specified ID for each student
            }
        }
    }

    if ($totalEleves > 0) {
        $groupAverage = $totalNotes / $totalEleves;
    } else {
        $groupAverage = 0;
    }

    return response()->json(['group_average' => $groupAverage]);
}


}
