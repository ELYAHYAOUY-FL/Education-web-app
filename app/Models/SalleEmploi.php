<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SalleEmploi
 * 
 * @property int|null $emploi_id
 * @property int|null $salle_id
 * 
 * @property EmploiTemp|null $emploi_temp
 * @property Salle|null $salle
 *
 * @package App\Models
 */
class SalleEmploi extends Model
{
	protected $table = 'salle_emploi';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'emploi_id' => 'int',
		'salle_id' => 'int'
	];

	protected $fillable = [
		'emploi_id',
		'salle_id'
	];

	public function emploi_temp()
	{
		return $this->belongsTo(EmploiTemp::class, 'emploi_id');
	}

	public function salle()
	{
		return $this->belongsTo(Salle::class);
	}
}
