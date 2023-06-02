<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EleveExames extends Model
{

    protected $table = 'eleve_exams';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'exame_id' => 'int',
		'eleve_id' => 'int',
	];

	protected $fillable = [
		'exame_id',
		'eleve_id' ,
	];

	public function eleve()
	{
		return $this->belongsTo(Eleve::class, 'eleve_id');
	}

	public function exam()
	{
		return $this->belongsTo(Exam::class, 'exame_id');
	}
}
