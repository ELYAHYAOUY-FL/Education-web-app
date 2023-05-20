<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payementsdemoi
 * 
 * @property int $id
 * @property Carbon $date
 * @property string $nom_compte
 * @property float $frais
 * @property bool $est_paye
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Parent[] $parents
 *
 * @package App\Models
 */
class Payementsdemoi extends Model
{
	protected $table = 'payementsdemois';

	protected $casts = [
		'date' => 'datetime',
		'frais' => 'float',
		'est_paye' => 'bool'
	];

	protected $fillable = [
		'date',
		'nom_compte',
		'frais',
		'est_paye'
	];

	public function parents()
	{
		return $this->hasMany(Parente::class, 'payement_id');
	}
}
