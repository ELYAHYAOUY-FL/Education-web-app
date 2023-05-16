<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Exam
 * 
 * @property int $id
 * @property Carbon $date
 * @property int $matiere_id
 * @property int $note_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Note $note
 *
 * @package App\Models
 */
class Exam extends Model
{
	protected $table = 'exams';

	protected $casts = [
		'date' => 'datetime',
		'matiere_id' => 'int',
		'note_id' => 'int'
	];

	protected $fillable = [
		'date',
		'matiere_id',
		'note_id'
	];

	public function note()
	{
		return $this->belongsTo(Note::class, 'id');
	}
}
