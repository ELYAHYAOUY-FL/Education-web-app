<?php

namespace App\Http\Controllers;

use App\Models\Payementsdemoi;
use Illuminate\Http\Request;

class PayementsdemoiController extends Controller
{
    public function index()
    {
        $paiements = Payementsdemoi::with('bankInformationParent.parent.user')->get();
    
        return response()->json($paiements);
    }
    
    
    public function store(Request $request)
    {
        $paymentData = [
            'bankinformation_parent_id' => $request->input('bankinfo_parent_id'), // Modifier le nom de la clé
            'montant' => $request->input('montant'),
            'mois' => $request->input('mois'),
            'date' => $request->input('date'),
            'est_paye' => $request->input('est_paye'),
            'année' => $request->input('année'), // Assurez-vous d'avoir également cette colonne dans votre base de données
        ];
    
        $payment = Payementsdemoi::create($paymentData);
    
        // Autres actions après avoir enregistré le paiement
    
        return response()->json(['message' => 'Payment created successfully']);
    }
    
    
    public function fetchPaymentRates()
    {
        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin']; // Liste des mois à utiliser

        $paymentRates = [];

        foreach ($months as $month) {
            $paidParentsCount = Payementsdemoi::where('mois', $month)
                ->where('est_paye', true)
                ->distinct('bankinformation_parent_id')
                ->count('bankinformation_parent_id');

            $paymentRates[$month] = $paidParentsCount;
        }

        return response()->json(['paymentRates' => $paymentRates]);
    }
}
