<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Matiere
 * 
 * @property int $id
 * @property string $titre
 * @property int $coefficient
 * @property int $professeur_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Professeur $professeur
 * @property Collection|Groupe[] $groupes
 * @property Collection|Devoir[] $devoirs
 * @property MatiereEmploi $matiere_emploi
 *
 * @package App\Models
 */
class Matiere extends Model
{
	protected $table = 'matieres';

	protected $casts = [
		'coefficient' => 'int',
		 
	];

	protected $fillable = [
		'titre',
		'coefficient',
		 
	];

	
    // public function groupes()
    // {
    //     return $this->belongsToMany( Groupe::class);
    // }


	public function professeurs()
{
    return $this->belongsToMany(Professeur::class);
}

	


	public function devoirs()
	{
		return $this->hasMany(Devoir::class);
	}
	public function exams()
	{
		return $this->hasMany(Exam::class);
	}
	public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'matiere_groupe', 'matiere_id', 'groupe_id');
    }

    public function emploiTemps()
    {
        return $this->hasMany(EmploiTemp::class, 'matiere_id');
    }

	 
}
