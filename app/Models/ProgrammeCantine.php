<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammeCantine extends Model
{
    use HasFactory;
    protected $table = 'programme_cantines'; // Remplacez 'programme_cantine' par le nom de votre table si nécessaire
    protected $fillable = ['nom', 'menu'];
}
