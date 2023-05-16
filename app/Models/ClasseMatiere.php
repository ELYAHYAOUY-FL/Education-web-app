<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClasseMatiere
 * 
 * @property int $classe_id
 * @property int $matiere_id
 * 
 * @property Class $class
 * @property Matiere $matiere
 *
 * @package App\Models
 */
class ClasseMatiere extends Model
{
	protected $table = 'classe_matiere';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'classe_id' => 'int',
		'matiere_id' => 'int'
	];

	public function class()
	{
		return $this->belongsTo(Classe::class, 'classe_id');
	}

	public function matiere()
	{
		return $this->belongsTo(Matiere::class);
	}
}
