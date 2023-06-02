<?php

namespace App\Models;

use App\Models\Groupe;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    protected $table = 'eleves';

    protected $casts = [
        'date_naissance' => 'datetime',
        'groupe_id' => 'int',
        'user_id' => 'int'
    ];

    protected $fillable = [
        'CNE',
        'photo',
        'groupe_id',
        'user_id'
    ];

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parents()
    {
        return $this->belongsToMany(Parente::class, 'eleve_parent', 'eleve_id', 'parent_id');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class, 'eleve_id');
    }

    public function eleve_notes()
    {
        return $this->hasMany(EleveNote::class, 'eleve_id');
    }

    public function eleve_exams()
    {
        return $this->belongsToMany(Exam::class, 'eleve_exams', 'eleve_id', 'exame_id');
    }

    public function eleve_parent()
    {
        return $this->hasOne(EleveParent::class, 'eleve_id');
    }

    public function eleve_exames()
    {
        return $this->hasMany(EleveExames::class, 'eleve_id');
    }

    public function eleve_professuers()
    {
        return $this->hasMany(EleveProfessuer::class, 'eleve_id');
    }

    public function retards()
    {
        return $this->hasMany(Retard::class, 'eleve_id');
    }
}
