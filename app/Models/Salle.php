<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    protected $fillable = ['numero', 'capacity'];

    public function emploiTemps()
    {
        return $this->hasOne(EmploiTemps::class);
    }
}

