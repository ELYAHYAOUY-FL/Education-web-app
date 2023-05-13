<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauScolaire extends Model
{
    use HasFactory;
    protected $fillable = ["nom"];
    public function etudiants(){
      return $this->hasMany(Etudiant::class);
      // cet fonction signifie que un niveau scolaire a beaucoup des etudiants 
    }
    public function professuers(){
      return $this->hasMany(Professeur::class);
      // cet fonction signifie que un niveau scolaire a beaucoup des etudiants 
    }

}