<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['date'];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }
}

