<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Devoir
 * 
 * @property int $id
 * @property Carbon $date_limite
 * @property string $description
 * @property string $fichier
 * @property int $matiere_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Matiere $matiere
 *
 * @package App\Models
 */
class Devoir extends Model
{
	protected $table = 'devoirs';

	protected $casts = [
		'date_limite' => 'datetime',
		'matiere_id' => 'int'
	];

	protected $fillable = [
		'date_limite',
		'description',
		'fichier',
		'matiere_id'
	];

	public function matiere()
	{
		return $this->belongsTo(Matiere::class);
	}
}
