<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $username
 * @property int|null $role_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Role|null $role
 * @property Elefe $elefe
 * @property Collection|Parent[] $parents
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'role_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'email',
		'password',
		'username',
		'role_id'
	];

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function eleve()
	{
		return $this->hasOne(Eleve::class);
	}

	public function parents()
	{
		return $this->hasMany(Parent::class);
	}
}
