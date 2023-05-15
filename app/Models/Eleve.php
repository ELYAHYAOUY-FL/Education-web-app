<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    protected $fillable = ['nom_francais', 'nom_arabe', 'prenom_francais', 'prenom_arabe', 'date_naissance', 'lieu_naissance', 'sex', 'photo', 'CNE'];

    public function parents()
    {
        return $this->belongsToMany(Parents::class);
    }
    public function Professeurs()
    {
        return $this->belongsToMany(Professeur::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function retards()
    {
        return $this->hasMany(Retard::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
