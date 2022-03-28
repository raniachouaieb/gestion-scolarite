<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Module;
use App\Models\Travail;

class Matiere extends Model
{
    protected $table='matieres';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nom',
        'coefficient',
        'module_id',
    ];
    protected $hidden=[
        'created_at','deleted_at','updated_at',

    ];

    public function student(){
        return $this->hasMany(Student::class);
    }

    public function module(){
        return $this->hasOne(Module::class , 'module_id', 'id');
    }

    public function travail(){
        return $this->belongsTo(Travail::class, 'matiere_id', 'id');
    }

    public function seances(){
        return $this->hasMany(Seance::class, 'matiere_id', 'id');
    }

}
