<?php

namespace App\Http\Controllers;
use App\Models\Exam;
use App\Models\Groupe;
use App\Models\EleveExames;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    //
    public function store(Request $request)
    {
      $validatedData = $request->validate([
       
      
        'date' => 'required',
		
		'nom'  => 'required',
		'matiere_id'  => 'required',
		'note_id' => 'required',
       
      ]);
  
      $exams = Exam::create($validatedData);
  
      return response()->json( $exams->id);
    }




    // public function calculerMoyenneParMatiere($groupeId)
    // {
    //     $groupe = Groupe::find($groupeId);
    //     $examName = 'First Exam';
    //     $matieres = $groupe->matieres;
    //     $moyennesParMatiere = [];
    
    //     foreach ($matieres as $matiere) {
    //         $eleves = $groupe->eleves;
    //         $totalNotes = 0;
    //         $nombreEleves = 0;
    
    //         foreach ($eleves as $eleve) {
    //             $note = $eleve->eleve_exames()
    //                 ->whereHas('exam', function ($query) use ($matiere, $examName) {
    //                     $query->where('matiere_id', $matiere->id)
    //                           ->where('nom', $examName);
    //                 })
    //                 ->first();
    
    //             if ($note) {
    //                 $totalNotes += $note->note->valeur;
    //                 $nombreEleves++;
    //             }
    //         }
    
    //         if ($nombreEleves > 0) {
    //             $moyenne = $totalNotes / $nombreEleves;
    //             $moyennesParMatiere[$matiere->titre] = $moyenne;
    //         } else {
    //             $moyennesParMatiere[$matiere->titre] = 'Aucune note disponible.';
    //         }
    //     }
    
    //     return $moyennesParMatiere;
    // }
    

    



  }