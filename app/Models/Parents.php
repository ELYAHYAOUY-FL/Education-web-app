<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Parents extends User
{
    protected $fillable = ['nom', 'prenom', 'date_naissance', 'lieu_naissance', 'tel', 'address', 'CNI'];

    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}


