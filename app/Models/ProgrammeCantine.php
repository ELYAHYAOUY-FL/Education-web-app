<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProgrammeCantine
 * 
 * @property int $id
 * @property string $nom
 * @property string|null $menu
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ProgrammeCantine extends Model
{
	protected $table = 'programme_cantines';

	protected $fillable = [
		'nom',
		'menu'
	];
}
