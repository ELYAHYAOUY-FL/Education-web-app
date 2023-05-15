<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiTemps extends Model
{
    protected $fillable = ['heure_debut', 'heure_fin','jour'];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function matieres()
    {
        return $this->belongsTomany(Matiere::class);
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }
}

