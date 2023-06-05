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
    //     foreach ($matieres as $matiere) {
    //         $matiere->pdf_url = Storage::disk('public')->url($matiere->pdf);
    //     }
    //     return response()->json($matieres);
    // }
    // public function index()
    // {
    //     $matieres = Matiere::all();
    //     return view('matieres.index', compact('matieres'));
    // }

    public function show($id)
    {
        $matiere = Matiere::find($id);

        if (!$matiere) {
            return response()->json(['error' => 'Matiere not found.'], 404);
        }
    
        return response()->json($matiere);
    }
    
    public function download($id)
    {
        $matiere = Matiere::findOrFail($id);
        $path = $matiere->pdf;
        return Storage::download($path);
    }
    
// public function download($id)
// {
//     $matiere = Matiere::findOrFail($id);

//     // Vérifier si le fichier PDF existe
//     if (!Storage::exists($matiere->pdf)) {
//         return response()->json(['error' => 'Le fichier PDF n\'existe pas.'], 404);
//     }

//     // Chemin complet du fichier PDF
//     $pdfPath = storage_path('app/public/' . $matiere->pdf);

//     // Télécharger le fichier PDF
//     return response()->download($pdfPath, 'document.pdf');
// }
// public function store(Request $request)
//     {
//         $subject = Matiere::create($request->all());
//         return response()->json($subject, 201);
//     }

public function store(Request $request)
{
    $matiere = Matiere::create($request->all());

    if ($request->hasFile('pdf')) {
        $path = $request->file('pdf')->store('pdfs');
        $matiere->pdf = $path;
        $matiere->save();
    }

    return redirect('/matieres');
}


    // Autres opérations après l'enregistrement

    



    
}
