<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'age',
        'phone_number',
        'address',
        'photo',
        'salaire',
        'diplome',
        'niveau_scolaire_id',
        'note_id',
        // Add other attributes here
    ];

    // Relationship with children (students)
    public function enfants()
    {
        return $this->hasMany(Etudiant::class);
    }
}
