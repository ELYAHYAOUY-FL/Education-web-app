<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EleveNote
 * 
 * @property int $note_id
 * @property int $eleve_id
 * @property int $id
 * 
 * @property Elefe $elefe
 * @property Note $note
 *
 * @package App\Models
 */
class EleveNote extends Model
{
	protected $table = 'eleve_note';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'note_id' => 'int',
		'eleve_id' => 'int',
		'id' => 'int'
	];

	protected $fillable = [
		'id'
	];

	public function eleve()
	{
		return $this->belongsTo(Elefe::class, 'eleve_id');
	}

	public function note()
	{
		return $this->belongsTo(Note::class);
	}
}
