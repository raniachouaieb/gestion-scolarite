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
        'niveau_id','basicStudy',
        'created_at','deleted_at','updated_at',
    ];

    public function matieres(){
        return $this->hasMany('App\Models\Matiere', 'module_id', 'id');
    }
    public function enseignants()
    {
        return $this->belongsToMany(\App\Models\Enseignant::class);
    }
    public function teachers()
    {
        return $this->hasMany(\App\Models\Enseignant_Module::class,'module_id','id')->orderByDesc('Created_at');

    }

}
