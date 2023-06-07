<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Matiere;
use Illuminate\Http\Request;

class AverageController extends Controller
{
    public function calculateAverages()
    {
        $students = Eleve::all();
        $subjects = Matiere::all();

        $averages = [];

        foreach ($students as $student) {
            $averages[$student->id] = [];

            foreach ($subjects as $subject) {
                $average = $this->calculateAverage($student->id, $subject->id);
                $averages[$student->id][$subject->id] = $average;
            }
        }

        return response()->json($averages);
    }

    private function calculateAverage($studentId, $subjectId)
    {
        // Perform your calculations to retrieve the average for the student and subject
        // You can use your existing relationships and queries to fetch the necessary data
        
        // Example: Calculate the average of notes for the student and subject using Eloquent relationships
        $average = Eleve::find($studentId)
            ->eleve_notes()
            ->whereHas('exam', function ($query) use ($subjectId) {
                $query->where('matiere_id', $subjectId);
            })
            ->avg('valeur');
        
        return $average;
    }
}

