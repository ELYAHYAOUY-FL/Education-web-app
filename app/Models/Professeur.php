<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Professeur
 * 
 * @property int $id
 * @property int $virement_id
 * @property string|null $photo
 * @property string $nom
 * @property string $prenom
 * @property string $sex
 * @property Carbon $date_naissance
 * @property string $lieu_naissance
 * @property string $tel
 * @property string $address
 * @property string $diplom
 * @property int|null $matier_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * 
 * @property Collection|Absence[] $absences
 * @property Collection|EleveProfessuer[] $eleve_professuers
 * @property Collection|Matiere[] $matieres
 * @property Collection|Retard[] $retards
 *
 * @package App\Models
 */
class Professeur extends User
{
	protected $table = 'professeurs';

	// protected $casts = [
	// 	'virement_id' => 'int',
	// 	'date_naissance' => 'datetime',
	// 	'matier_id' => 'int'
	// ];

	protected $fillable = [
		 
		'photo',
		'tel',
		'diplom',
	];

	
	// public function virement()
    // {
    //     return $this->belongsTo(Virement::class);
    // }

	public function absences()
	{
		return $this->hasMany(Absence::class);
	}

	public function eleve_professuers()
	{
		return $this->hasMany(EleveProfessuer::class);
	}

	

    // public function groupes()
    // {
    //     return $this->matieres()->with('groupes');
    // }
	
	public function matieres()
	{
		return $this->hasMany(Matiere::class);
	}
	



	public function retards()
	{
		return $this->hasMany(Retard::class);
	}
}
