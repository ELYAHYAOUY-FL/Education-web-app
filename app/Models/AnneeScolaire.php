<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AnneeScolaire
 * 
 * @property int $id
 * @property Carbon $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AnneNiveau $anne_niveau
 *
 * @package App\Models
 */
class AnneeScolaire extends Model
{
	protected $table = 'annee_scolaire';

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'date'
	];

	public function anne_niveau()
	{
		return $this->hasOne(AnneNiveau::class, 'anneScolaire_id');
	}
}
