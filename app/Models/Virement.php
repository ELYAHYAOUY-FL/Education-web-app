<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Virement extends Model
{
    protected $fillable = ['salaire', 'est_paye', 'rib', 'date'];

    public function professeurs()
    {
        return $this->belongsToMany(Professeur::class, 'professeur_virement');
    }
}

