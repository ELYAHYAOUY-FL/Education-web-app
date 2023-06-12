<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\Bankinformation_Parent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payementsdemoi
 * 
 * @property int $id
 * @property Carbon $date
 * @property string $nom_compte
 * @property float $frais
 * @property bool $est_paye
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Parent[] $parents
 *
 * @package App\Models
 */
class Payementsdemoi extends Model
{
	protected $table = 'payementsdemois';

    protected $fillable = [
        'bankinformation_parent_id',
        'date',
        'mois',
        'année',
        'montant',
        'est_paye',
    ];

    public function bankInformationParent()
    {
        return $this->belongsTo(Bankinformation_Parent::class, 'bankinformation_parent_id');
    }
	// public function parents()
	// {
	// 	return $this->hasMany(Parente::class, 'payement_id');
	// }

	 
	 
}
