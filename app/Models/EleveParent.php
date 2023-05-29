<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Parente;

/**
 * Class EleveParent
 * 
 * @property int $eleve_id
 * @property int $parent_id
 * @property int $id
 * 
 * @property Eleve $eleve
 * @property Parente $parent
 *
 * @package App\Models
 */
class EleveParent extends Model
{
	protected $table = 'eleve_parent';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'eleve_id' => 'int',
		'parent_id' => 'int',
		'id' => 'int'
	];

	protected $fillable = [
		'eleve_id',
		'parent_id'
	];

// 	public function eleve()
// 	{
// 		return $this->belongsTo(Eleve::class, 'eleve_id');
// 	}

// 	public function parent()
// {
//     return $this->belongsTo(Parente::class, 'parent_id');
// }
public function eleve()
{
	return $this->belongsTo(Eleve::class, 'eleve_id');
}

public function parent()
{
	return $this->belongsTo(Parente::class, 'parent_id');
}

}
