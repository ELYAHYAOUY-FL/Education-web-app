<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    protected $fillable = ['date'];

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'annee_scolaire_eleve');
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'annee_scolaire_classe');
    }
}

