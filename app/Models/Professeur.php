<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends User
{
    protected $fillable = ['photo', 'nom', 'prenom', 'sex', 'date_naissance', 'lieu_naissance', 'tel', 'address', 'diplom'];

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function retards()
    {
        return $this->hasMany(Retard::class);
    }

    public function emploisTemps()
    {
        return $this->belongsToMany(EmploiTemps::class);
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class);
    }

    public function virements()
    {
        return $this->hasMany(Virement::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function devoirs()
    {
        return $this->hasMany(Devoir::class);
    }
    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }
}


