<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cantine extends Model
{
    protected $fillable = ['nom',  'jour', 'menu', ];
}

