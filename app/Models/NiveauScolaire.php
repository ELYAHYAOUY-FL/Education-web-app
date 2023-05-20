<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauScolaire extends Model
{
    protected $fillable = ['nom', 'description'];

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}

