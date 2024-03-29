<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\CarnetNote;
use App\Models\Eleve;
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
 * @property Collection|Eleve[] $eleves
 * @property Collection|EmploiTemp[] $emploi_temps
 *
 * @package App\Models
 */
class Groupe extends Model
{
	protected $table = 'groupes';

	protected $casts = [
		'capacity' => 'int',
		'niveau_scolaire_id' => 'int',
		 'salle' =>'string',
	];

	protected $fillable = [
		'nom',
		'capacity',
		'niveau_scolaire_id',
		 'salle',
	];
	public function niveau_scolaire()
	{
		return $this->belongsTo(NiveauScolaire::class,'niveau_scolaire_id');
	}
	public function professeurs ()
    {
        return $this->belongsToMany(Professeur::class, 'groupe_professeur', 'professeur_id', 'groupe_id');
    }
	
	// public function emploi()
	// {
	// 	return $this->belongsTo(Emploi::class);
	// }
	
	// public function niveau_scolaire()
	// {
	// 	return $this->belongsTo(NiveauScolaire::class);
	// }

	// public function emploi_temp()
	// {
	// 	return $this->belongsTo(EmploiTemp::class, 'emploi_id');
	// }

	public function matieres()
	{
		return $this->belongsToMany(Matiere::class, 'groupe_matiere', 'groupe_id', 'matiere_id');
	}
	

	public function eleves()
	{
		return $this->hasMany(Eleve::class, 'groupe_id');
	}
	public function carnetNotes()
    {
        return $this->hasMany(CarnetNote::class);
    }
	// public function matieres()
    // {
    //     return $this->belongsToMany(Matiere::class, 'groupe_matiere', 'groupe_id', 'matiere_id');
    // }

     

	public function emploiTemp()
    {
        return $this->hasMany(EmploiTemp::class, 'groupe_id');
    }
	
}
