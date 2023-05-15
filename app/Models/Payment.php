<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = ['date', 'nom_compte', 'frais', 'est_paye'];

    public function parents()
    {
        return $this->belongsToMany(Parents::class);
    }
}


