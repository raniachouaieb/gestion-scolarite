<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Matiere;
class Module extends Model
{
    protected $table='modules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nom_module',
        'coefficient_module',
        'niveau_id',
        'created_at','deleted_at','updated_at',
    ];

    public function matieres(){
        return $this->hasMany(Matiere::class, 'module_id', 'id');
    }

}
