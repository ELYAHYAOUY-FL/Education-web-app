<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Retard
 * 
 * @property int $id
 * @property Carbon $date
 * @property string $motif
 * @property Carbon $heure_debut
 * @property Carbon $heure_fin
 * @property int $professeur_id
 * @property int $eleve_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Elefe $elefe
 * @property Professeur $professeur
 *
 * @package App\Models
 */
class Retard extends Model
{
	protected $table = 'retards';

	protected $casts = [
		'date' => 'datetime',
		'heure_debut' => 'datetime',
		'heure_fin' => 'datetime',
		'professeur_id' => 'int',
		'eleve_id' => 'int'
	];

	protected $fillable = [
		'date',
		'motif',
		'heure_debut',
		'heure_fin',
		'professeur_id',
		'eleve_id'
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
