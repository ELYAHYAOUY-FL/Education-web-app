<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class  GroupeMatiere
 * 
 * @property int $groupe_id
 * @property int $matiere_id
 * 
 * @property  Groupe $class
 * @property Matiere $matiere
 *
 * @package App\Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class  GroupeMatiere extends Model
{
    protected $table = ' Groupe_matiere';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        ' groupe_id' => 'int',
        'matiere_id' => 'int'
    ];

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id');
    }


    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }



}


