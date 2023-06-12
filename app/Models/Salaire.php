<?php

namespace App\Models;
use App\Models\Bankinformation_Prof;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    use HasFactory;
    protected $table = 'salaires';

    protected $fillable = [
        'bankinformation_prof_id',
        'date',
        'mois',
        'année',
        'montant',
        'est_paye',
    ];

     
    public function bankInformationProf()
    {
        return $this->belongsTo(Bankinformation_Prof::class, 'bankinformation_prof_id');
    }
}
