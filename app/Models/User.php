<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

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
        'user_type',
        'adresse',
        
    ];
    public function parent()
    {
        return $this->hasOne(Parente::class, 'user_id');
    }
    
}
