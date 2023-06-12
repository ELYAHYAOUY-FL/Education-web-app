<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Devoir
 * 
 * @property int $id
 * @property Carbon $date_limite
 * @property string $description
 * @property string $fichier
 * @property int $matiere_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Matiere $matiere
 *
 * @package App\Models
 */
class Devoir extends Model
{
	protected $table = 'devoirs';

	// protected $casts = [
	// 	'date_limite' => 'datetime',
		 
	// ];

	protected $fillable = [
		'titre',
		'description',
		'fichier',
		'date_limite',
		'valide',
		 'groupe_id',
		 'professeur_id'
	];

	public function matiere()
	{
		return $this->belongsTo(Matiere::class);
	}
	
    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'professeur_id');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id');
    }
	public function eleves(){
        return $this->belongsToMany(Devoir::class,'eleve_devoire' , 'devoir_id' , 'eleve_id')->withPivot('validation');
    }
}
