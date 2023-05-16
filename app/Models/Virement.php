<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Virement
 * 
 * @property int $id
 * @property float $salaire
 * @property bool $est_paye
 * @property string $rib
 * @property Carbon $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Professeur[] $professeurs
 *
 * @package App\Models
 */
class Virement extends Model
{
	protected $table = 'virements';

	protected $casts = [
		'salaire' => 'float',
		'est_paye' => 'bool',
		'date' => 'datetime'
	];

	protected $fillable = [
		'salaire',
		'est_paye',
		'rib',
		'date'
	];

	public function professeurs()
	{
		return $this->hasMany(Professeur::class);
	}
}
