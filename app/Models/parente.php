<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parente extends Model
{
    protected $fillable = [
        'user_id',
        'username',
        'password',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        // Add other attributes here
    ];

    // Relationship with children (students)
    public function Etudiant()
    {
        return $this->hasMany(Etudiant::class);
    }
   
}
