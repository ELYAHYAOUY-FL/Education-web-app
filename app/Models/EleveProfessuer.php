<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EleveProfessuer
 * 
 * @property int $eleve_id
 * @property int $professeur_id
 * 
 * @property Eleve $eleve
 * @property Professeur $professeur
 *
 * @package App\Models
 */
class EleveProfessuer extends Model
{
	protected $table = 'eleve_professuer';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'eleve_id' => 'int',
		'professeur_id' => 'int'
	];

	public function eleve()
	{
		return $this->belongsTo(Eleve::class, 'eleve_id');
	}

	public function professeur()
	{
		return $this->belongsTo(Professeur::class);
	}
}
