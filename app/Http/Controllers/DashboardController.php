<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Professeur;
use App\Models\NiveauScolaire;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboardData()
    {
        try{
            $totalStudents = Etudiant::count();
            $totalTeachers = Professeur::count();
            $totalSchoolLevels = NiveauScolaire::count();
            // Autres statistiques...
    
            $dashboardData = [
                'totalStudents' => $totalStudents,
                'totalTeachers' => $totalTeachers,
                'totalSchoolLevels' => $totalSchoolLevels,
                // Autres statistiques...
            ];
    
            return response()->json($dashboardData);
        }catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // Récupérer les statistiques depuis la base de données ou d'autres sources
       
    }
}
