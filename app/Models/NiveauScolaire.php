<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class NiveauScolaire extends Model
{
	protected $table = 'niveau_scolaires';

	protected $fillable = [
		'nom',
		'description',
		'année_scolaire'
	];

	// public function anne_niveau()
	// {
	// 	return $this->hasOne(AnneNiveau::class, 'niveauScolaire_id');
	// }

	public function groupes()
	{
		return $this->hasMany(Groupe::class);
	}
}
