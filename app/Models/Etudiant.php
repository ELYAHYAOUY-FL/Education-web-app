<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ["nom", "prenom","photo", "sex", "age", "niveau_scolaire_id","datenaissance"];

    public function niveau_scolaire(){
        // return $this->belongsTo(NiveauScolaire::class);
        return $this->belongsTo(NiveauScolaire::class, 'niveau_scolaire_id');
    }
}