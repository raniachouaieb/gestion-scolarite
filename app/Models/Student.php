<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Parente;
use App\Models\Convocation;
use App\Models\Classroom;
use App\Models\Matiere;
use App\Models\Absence;

class Student extends Model
{

    protected $fillable=[
        'nomEleve','prenomEleve','gender','classe','class_id',
        'niveau', 'parent_id','birth',
    ];
    protected $hidden=[
        'created_at','deleted_at','updated_at'
        ];
 //each student have one parent
    public function parent(){
        return $this->belongsTo(Parente::class,'parent_id', 'id');
    }

    public function class(){
        return $this->belongsTo(Classroom::class, 'class_id', 'id');
    }

    public function matiere(){
        return $this->hasMany(Matiere::class);
    }

    public function convocations(){
        return $this->hasMany(Convocation::class , 'student_id', 'id');
    }

    public function absences(){
        return $this->belongsToMany(Absence::class, 'eleve_id','id');
    }
    public function observations()
    {
        return $this->belongsTo('App\Models\Observation','student_id','id');
    }
    public function notes(){
        return $this->hasMany('App\Models\Note', 'student_id','id');
    }
}
