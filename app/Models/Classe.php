<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Class
 * 
 * @property int $id
 * @property string $nom
 * @property int $capacity
 * @property int $niveau_scolaire_id
 * @property int $emploi_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property NiveauScolaire $niveau_scolaire
 * @property EmploiTemp $emploi_temp
 * @property Collection|Matiere[] $matieres
 * @property Collection|Elefe[] $eleves
 * @property Collection|EmploiTemp[] $emploi_temps
 *
 * @package App\Models
 */
class Classe extends Model
{
	protected $table = 'classes';

	protected $casts = [
		'capacity' => 'int',
		'niveau_scolaire_id' => 'int',
		'emploi_id' => 'int'
	];

	protected $fillable = [
		'nom',
		'capacity',
		'niveau_scolaire_id',
		'emploi_id'
	];
	public function niveau_scolaire()
	{
		return $this->belongsTo(NiveauScolaire::class);
	}
	
	// public function emploi()
	// {
	// 	return $this->belongsTo(Emploi::class);
	// }
	
	// public function niveau_scolaire()
	// {
	// 	return $this->belongsTo(NiveauScolaire::class);
	// }

	public function emploi_temp()
	{
		return $this->belongsTo(EmploiTemp::class, 'emploi_id');
	}

	public function matieres()
	{
		return $this->belongsToMany(Matiere::class, 'classe_matiere', 'classe_id');
	}
	

	public function eleves()
	{
		return $this->hasMany(Eleve::class, 'classe_id');
	}

	public function emploi_temps()
	{
		return $this->hasMany(EmploiTemp::class, 'classe_id');
	}
}
