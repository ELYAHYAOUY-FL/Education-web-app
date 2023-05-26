<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Textbook extends Model
{
    use HasFactory;
    protected $table = 'textbooks';

    protected $fillable = [
        'professeur_id',
        'title',
        'description',
        'date',
        'heure',
    ];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }
}
