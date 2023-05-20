<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AnneNiveau
 * 
 * @property int|null $anneScolaire_id
 * @property int|null $niveauScolaire_id
 * 
 * @property NiveauScolaire|null $niveau_scolaire
 * @property AnneeScolaire|null $annee_scolaire
 *
 * @package App\Models
 */
class AnneNiveau extends Model
{
	protected $table = 'anne_niveau';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'anneScolaire_id' => 'int',
		'niveauScolaire_id' => 'int'
	];

	protected $fillable = [
		'anneScolaire_id',
		'niveauScolaire_id'
	];

	public function niveau_scolaire()
	{
		return $this->belongsTo(NiveauScolaire::class, 'niveauScolaire_id');
	}

	public function annee_scolaire()
	{
		return $this->belongsTo(AnneeScolaire::class, 'anneScolaire_id');
	}
}
