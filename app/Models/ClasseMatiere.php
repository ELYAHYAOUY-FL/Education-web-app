<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClasseMatiere
 * 
 * @property int $classe_id
 * @property int $matiere_id
 * 
 * @property Classe $class
 * @property Matiere $matiere
 *
 * @package App\Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClasseMatiere extends Model
{
    protected $table = 'classe_matiere';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'classe_id' => 'int',
        'matiere_id' => 'int'
    ];

    public function classe()
{
    return $this->belongsTo(Classe::class);
}


    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }
}

