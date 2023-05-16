<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Salle
 * 
 * @property int $id
 * @property string $numero
 * @property int $capacity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property SalleEmploi $salle_emploi
 *
 * @package App\Models
 */
class Salle extends Model
{
	protected $table = 'salles';

	protected $casts = [
		'capacity' => 'int'
	];

	protected $fillable = [
		'numero',
		'capacity'
	];

	public function salle_emploi()
	{
		return $this->hasOne(SalleEmploi::class);
	}
}
