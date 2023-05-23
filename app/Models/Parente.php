<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use App\Models\Eleve;
use App\Models\EleveParent;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Parent
 * 
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property Carbon $date_naissance
 * @property string $lieu_naissance
 * @property string $tel
 * @property string $address
 * @property string $CNI
 * @property int $payement_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Payementsdemoi $payementsdemoi
 * @property User $user
 * @property Collection|EleveParent[] $eleve_parents
 *
 * @package App\Models
 */
class Parente extends Model
{
	protected $table = 'parents';

	protected $casts = [
		'date_naissance' => 'datetime',
		'payement_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'nom',
		'prenom',
		'date_naissance',
		'lieu_naissance',
		'tel',
		'address',
		'CNI',
		'payement_id',
		'user_id'
	];

	public function payementsdemoi()
	{
		return $this->belongsTo(Payementsdemoi::class, 'payement_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function eleve_parents()
	{
		return $this->hasMany(EleveParent::class);
	}
	public function eleves()
{
    return $this->belongsToMany(Eleve::class, 'eleve_parent', 'parent_id', 'eleve_id');
}

}
