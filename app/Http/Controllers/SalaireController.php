<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Salaire;
use Illuminate\Http\Response;

class SalaireController extends Controller
{
    public function index()
    {
        $paiements = Salaire::with('bankInformationProf.professeur.user')->get();
    
        return response()->json($paiements);
    }
    
    
    public function store(Request $request)
    {
        $paymentData = [
            'bankinformation_prof_id' => $request->input('bankinfo_prof_id'), // Modifier le nom de la clé
            'montant' => $request->input('montant'),
            'mois' => $request->input('mois'),
            'date' => $request->input('date'),
            'est_paye' => $request->input('est_paye'),
            'année' => $request->input('année'), // Assurez-vous d'avoir également cette colonne dans votre base de données
        ];
    
        $payment =  Salaire::create($paymentData);
    
        // Autres actions après avoir enregistré le paiement
    
        return response()->json(['message' => 'Payment created successfully']);
    }
    
    
}

