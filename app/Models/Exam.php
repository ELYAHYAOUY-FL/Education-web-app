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
		
		'nom',
		'matiere_id',
		'note_id'
	];

	public function note()
	{
		return $this->belongsTo(Note::class, 'id');
	}
	public function matire()
	{
		return $this->belongsTo(Matiere::class, 'id');
	}
	public function eleves_exam()
    {
        return $this->belongsToMany(Eleve::class, 'eleve_exams','eleve_id','exame_id');
    }
	public function eleve_exames()
    {
        return $this->hasMany(EleveExames::class, 'exame_id');
    }
}
