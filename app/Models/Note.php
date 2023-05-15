<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['valeur', 'date'];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'eleve_note');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}

