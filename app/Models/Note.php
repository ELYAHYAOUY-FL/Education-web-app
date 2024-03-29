<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Note
 * 
 * @property int $id
 * @property int $valeur
 * @property Carbon $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property EleveNote $eleve_note
 * @property Exam $exam
 *
 * @package App\Models
 */
class Note extends Model
{
	protected $table = 'notes';

	protected $casts = [
		'valeur' => 'int',
		
	];

	protected $fillable = [
		'valeur',
		
	];

	

	public function exam()
	{
		return $this->hasOne(Exam::class, 'id');
	}
}
