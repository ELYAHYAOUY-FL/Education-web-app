<?php

namespace App\Models;
 
use App\Models\Parente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bankinformation_Parent extends Model
{
    use HasFactory;
  
    protected $table = 'bankinformation_parents';

    protected $fillable = [
        'parent_id',
        'numero_compte',
        'type_bank',
    ];

    public function parent()
    {
        return $this->belongsTo(Parente::class);
    }

    public function payementsdemois()
    {
        return $this->hasMany(Payementsdemois::class);
    }
}
