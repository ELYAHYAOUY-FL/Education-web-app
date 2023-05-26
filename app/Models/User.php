<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_francais',
        'nom_arabe',
        'prenom_francais',
        'prenom_arabe',
        'date_naissance',
        'lieu_naissance',
        'sex',
        'email',
        'password',
        'username',
        'usertype',
        'adresse',
    ];
}
