<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NiveauScolaire
 * 
 * @property int $id
 * @property string $nom
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AnneNiveau $anne_niveau
 * @property Collection|Class[] $classes
 *
 * @package App\Models
 */
class NiveauScolaire extends Model
{
	protected $table = 'niveau_scolaires';

	protected $fillable = [
		'nom',
		'description'
	];

	public function anne_niveau()
	{
		return $this->hasOne(AnneNiveau::class, 'niveauScolaire_id');
	}

	public function classes()
	{
		return $this->hasMany(Classe::class);
	}
}
