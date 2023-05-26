<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class EmploiTemp extends Model
{
	protected $table = 'emploi_temps';

	protected $casts = [
		'heure_debut' => 'datetime',
		'heure_fin' => 'datetime',
		'jour' => 'string'
	];

	protected $fillable = [
		'heure_debut',
		'heure_fin',
		'jour',
		
	];

	

	// public function classes()
	// {
	// 	return $this->hasOne(Classe::class, 'emploi_id');
	// }

	public function matiere_emploi()
	{
		return $this->hasOne(MatiereEmploi::class, 'emploi_id');
	}

	// public function salle_emploi()
	// {
	// 	return $this->hasOne(SalleEmploi::class, 'emploi_id');
	// }
}
