<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Elefe
 * 
 * @property int $id
 * @property string $nom_francais
 * @property string $nom_arabe
 * @property string $prenom_francais
 * @property string $prenom_arabe
 * @property Carbon $date_naissance
 * @property string $lieu_naissance
 * @property string $sex
 * @property string|null $photo
 * @property string $CNE
 * @property int $classe_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Class $class
 * @property User $user
 * @property Collection|Absence[] $absences
 * @property Collection|EleveNote[] $eleve_notes
 * @property EleveParent $eleve_parent
 * @property Collection|EleveProfessuer[] $eleve_professuers
 * @property Collection|Retard[] $retards
 *
 * @package App\Models
 */
class Eleve extends Model
{
	protected $table = 'eleves';

	protected $casts = [
		'date_naissance' => 'datetime',
		'classe_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'nom_francais',
		'nom_arabe',
		'prenom_francais',
		'prenom_arabe',
		'date_naissance',
		'lieu_naissance',
		'sex',
		'photo',
		'CNE',
		'classe_id',
		'user_id'
	];

	public function classe()
	{
		return $this->belongsTo(Classe::class, 'classe_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function absences()
	{
		return $this->hasMany(Absence::class, 'eleve_id');
	}

	public function eleve_notes()
	{
		return $this->hasMany(EleveNote::class, 'eleve_id');
	}

	public function eleve_parent()
	{
		return $this->hasOne(EleveParent::class, 'eleve_id');
	}

	public function eleve_professuers()
	{
		return $this->hasMany(EleveProfessuer::class, 'eleve_id');
	}

	public function retards()
	{
		return $this->hasMany(Retard::class, 'eleve_id');
	}
}
