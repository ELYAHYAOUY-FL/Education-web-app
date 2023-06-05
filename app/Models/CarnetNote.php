<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarnetNote extends Model
{
    use HasFactory;
      protected $table = 'carnetnotes';
    protected $fillable = ['professeur_id', 'groupe_id', 'contenu', 'date'];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'professeur_id');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id');
    }
}
