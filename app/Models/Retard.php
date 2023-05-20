<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retard extends Model
{
    protected $fillable = ['date', 'motif', 'heure_debut', 'heure_fin'];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }

    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }
}

