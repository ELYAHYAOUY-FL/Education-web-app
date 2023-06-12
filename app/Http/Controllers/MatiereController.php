<?php

namespace App\Http\Controllers;
use App\Models\Matiere;
use Illuminate\Support\Facades\Storage;



use Illuminate\Http\Request;

class MatiereController extends Controller{

    
    public function index()
    {
        $matiers = Matiere::with("professeur")->get();

        return response()->json($matiers);
            
    }
    // public function index()
    // {
    //     $matieres = Matiere::all();
    //     return response()->json($matieres);
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'coefficient' => 'required',
            'pdf' => 'required|mimes:pdf|max:4096',
        ]);

        // Enregistrement du fichier PDF
        $pdfPath = $request->file('pdf')->store('public/pdf');

        $matiere = Matiere::create([
            'titre' => $validatedData['titre'],
            'description' => $validatedData['description'],
            'coefficient' => $validatedData['coefficient'],
            'pdf' => $pdfPath,
        ]);

        return response()->json($matiere, 201);
    }
    // public function downloadPdf(Matiere $matiere)
    // {
    //     $pdfPath = $matiere->getPdfPath();
    //     return response()->download($pdfPath);
    // }
//     public function downloadPdf($filename)
// {

//   $filePath = storage_path('app/public/pdf/' . $filename);


//     if (!Storage::exists($filePath)) {
//         abort(404);
//     }

//     return response()->download($filePath, $filename);
// }
public function update(Request $request, Matiere $matiere)
{
    $validatedData = $request->validate([
        'titre' => 'required',
        'description' => 'required',
        'coefficient' => 'required',
        'pdf' => 'sometimes|mimes:pdf|max:2048',
    ]);

    // Mise à jour des champs titre et description
    $matiere->titre = $validatedData['titre'];
    $matiere->description = $validatedData['description'];
    $matiere->coefficient = $validatedData['coefficient'];

    // Vérification et mise à jour du fichier PDF
    if ($request->hasFile('pdf')) {
        // Suppression de l'ancien fichier PDF s'il existe
        Storage::delete($matiere->pdf);

        // Enregistrement du nouveau fichier PDF
        $pdfPath = $request->file('pdf')->store('pdf', 'public');
        $matiere->pdf = $pdfPath;
    }

    // Sauvegarde de la matière mise à jour
    $matiere->save();

    return response()->json($matiere, 200);
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

// private function calculateAverage($matiereId)
// {
//     $exams = Exam::where('matiere_id', $matiereId)->get();
//     $total = 0;
//     $count = $exams->count();

//     if ($count === 0) {
//         return 0; // Return 0 if there are no exams for the given matiere
//     }

//     foreach ($exams as $exam) {
//         $total += $exam->note;
//     }

//     $average = $total / $count;

//     return $average;
// }


}
