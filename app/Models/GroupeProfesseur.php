<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeProfesseur extends Model
{
    use HasFactory;
    protected $table = 'groupe_professeur';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
	
		'professeur_id' => 'int',
		'groupe_id' => 'int'
	];

	protected $fillable = [
		
		'professeur_id',
		'groupe_id'
	];
  
}
