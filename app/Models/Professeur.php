<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\CarnetNote;
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
class Professeur extends Model
{
	protected $table = 'professeurs';

	protected $casts = [
		'date_naissance' => 'datetime',
		'user_id' => 'int'
		
	];

	protected $fillable = [
		 
		'photo',
		'tel',
		'diplom',
		'CNI',
		 'user_id' => 'int',
		 'matier_id' => 'int',
	];

	
	// public function virement()
    // {
    //     return $this->belongsTo(Virement::class);
    // }
	public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
	public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matier_id');
    }

	public function absences()
	{
		return $this->hasMany(Absence::class);
	}
	public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'groupe_professeur', 'professeur_id', 'groupe_id');
    }

	public function eleve_professuers()
	{
		return $this->hasMany(EleveProfessuer::class);
	}
	public function carnetNotes()
    {
        return $this->hasMany(CarnetNote::class);
    }
	

    // public function groupes()
    // {
    //     return $this->matieres()->with('groupes');
    // }
	
	// public function matieres()
	// {
	// 	return $this->hasMany(Matiere::class);
	// }
	
	
	public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'matiere_professeur', 'professeur_id', 'matiere_id');
    }

	public function retards()
	{
		return $this->hasMany(Retard::class);
	}
}
