<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\Groupe;
use App\Models\MatiereEmploi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matiere;


class EmploiTemp extends Model
{
	protected $table = 'emploi_temps';

	// protected $casts = [
	// 	// 'heure_debut' => 'datetime',
	// 	// 'heure_fin' => 'datetime',
	// 	// 'description' => 'text',
	// 	// 'jour' => 'string',
	// 	'groupe_id' => 'int',
	// 	'matiere_id' => 'int',
	// 	'description' => 'text',
	// ];

	protected $fillable = [
		'heure_debut',
		'heure_fin',
		'description' ,
		'jour',
		'matiere_id',
		'groupe_id',
		
	];

	public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }
	public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id');
    }
	 
	 

	 

	/**
	 * @return mixed
	 */
	public function getFillable() {
		return $this->fillable;
	}
	
	/**
	 * @param mixed $fillable 
	 * @return self
	 */
	public function setFillable($fillable): self {
		$this->fillable = $fillable;
		return $this;
	}
}
