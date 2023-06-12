<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Cours extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'contenu', 'groupe_id', 'fichier', 'professeur_id'];

    
    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'professeur_id');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id');
    }

    public function getFichierUrlAttribute()
    {
        return $this->fichier ? Storage::url($this->fichier) : null;
    }
}
