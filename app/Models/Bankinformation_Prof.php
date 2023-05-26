<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bankinformation_Prof extends Model
{
    use HasFactory;
    protected $table = 'bankinformation_profs';

    protected $fillable = [
        'professeur_id',
        'rib',
        'numero_compte',
        'type_bank',
    ];
    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }

    public function salaires()
    {
        return $this->hasMany(Salaire::class);
    }
}
