<?php

namespace App\Http\Controllers;
use App\Models\Matiere;


use Illuminate\Http\Request;

class MatiereController extends Controller
{
    //
    // public function index()
    // {
    //     $matiers = Matiere::with("professeur")->get();

    //     return response()->json($matiers);
            
    // }
    public function index()
{
    $matieres = Matiere::with('groupes')->get();

    return response()->json($matieres);
}
 
public function downloadPdf($filename)
{
    $filePath = storage_path('app/public/pdf/' . $filename);
    $matieres = Matiere::with('groupes')->get();

    if (!Storage::exists($filePath)) {
        abort(404);
    }

    return response()->download($filePath, $filename);
}

public function getAverageByMatiere(Request $request, $matiereId)
{
    $average = $this->calculateAverage($matiereId);

    return response()->json(['average' => $average]);
}

private function calculateAverage($matiereId)
{
    $exams = Exam::where('matiere_id', $matiereId)->get();
    $total = 0;
    $count = $exams->count();

    if ($count === 0) {
        return 0; // Return 0 if there are no exams for the given matiere
    }

    foreach ($exams as $exam) {
        $total += $exam->note;
    }

    $average = $total / $count;

    return $average;
}


}
