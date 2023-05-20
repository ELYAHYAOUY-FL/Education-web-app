<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
     use HasFactory;
    protected $fillable = ['nom', 'description', 'date', 'heure', 'photo'];
    public static $rules = [
        'nom' => 'required|string',
        'description' => 'required|string',
        'date' => 'required|date',
        'heure' => 'required|time',
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
}
