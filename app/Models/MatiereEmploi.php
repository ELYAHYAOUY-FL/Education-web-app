<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MatiereEmploi
 * 
 * @property int $id
 * @property int|null $emploi_id
 * @property int|null $matiere_id
 * 
 * @property EmploiTemp|null $emploi_temp
 * @property Matiere|null $matiere
 *
 * @package App\Models
 */
class MatiereEmploi extends Model
{
	protected $table = 'matiere_emploi';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'emploi_id' => 'int',
		'matiere_id' => 'int'
	];

	protected $fillable = [
		'id',
		'emploi_id',
		'matiere_id'
	];

	public function emploi_temp()
	{
		return $this->belongsTo(EmploiTemp::class, 'emploi_id');
	}

	public function matiere()
	{
		return $this->belongsTo(Matiere::class);
	}
}
