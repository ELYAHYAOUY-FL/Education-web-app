<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmploiTemp
 * 
 * @property int $id
 * @property Carbon $heure_debut
 * @property Carbon $heure_fin
 * @property string $jour
 * @property int $classe_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Class $class
 * @property Collection|Class[] $classes
 * @property MatiereEmploi $matiere_emploi
 * @property SalleEmploi $salle_emploi
 *
 * @package App\Models
 */
class EmploiTemp extends Model
{
	protected $table = 'emploi_temps';

	protected $casts = [
		'heure_debut' => 'datetime',
		'heure_fin' => 'datetime'
		
	];

	protected $fillable = [
		'heure_debut',
		'heure_fin',
		'jour',
		
	];

	

	public function classes()
	{
		return $this->hasOne(Classe::class, 'emploi_id');
	}

	public function matiere_emploi()
	{
		return $this->hasOne(MatiereEmploi::class, 'emploi_id');
	}

	public function salle_emploi()
	{
		return $this->hasOne(SalleEmploi::class, 'emploi_id');
	}
}
