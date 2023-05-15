<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable = ['nom', 'capacity'];

    public function niveauScolaire()
    {
        return $this->belongsTo(NiveauScolaire::class);
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'classe_matiere');
    }

    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }

    public function devoirs()
    {
        return $this->hasMany(Devoir::class);
    }

    public function emploiTemps()
    {
        return $this->hasOne(EmploiTemps::class);
    }
}

