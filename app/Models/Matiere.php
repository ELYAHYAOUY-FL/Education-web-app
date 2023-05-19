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
 * @property Collection|Class[] $classes
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
		'professeur_id' => 'int'
	];

	protected $fillable = [
		'titre',
		'coefficient',
		'professeur_id'
	];

	public function professeur()
	{
		return $this->belongsTo(Professeur::class);
	}

	
	// public function classes()
	// {
	// 	return $this->belongsToMany(Classe::class, 'classe_matiere', 'matiere_id', 'classe_id');
	// }
	public function professeurs()
    {
        return $this->belongsToMany(Professeur::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class);
    }

	


	public function devoirs()
	{
		return $this->hasMany(Devoir::class);
	}

	public function matiere_emploi()
	{
		return $this->hasOne(MatiereEmploi::class);
	}
}
