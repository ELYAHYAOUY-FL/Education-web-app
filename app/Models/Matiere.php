<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $fillable = ['titre', 'coefficient'];

    public function emploiTemps()
    {
        return $this->belongsToMany(EmploiTemps::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class);
    }

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function devoirs()
    {
        return $this->hasMany(Devoir::class);
    }
}

