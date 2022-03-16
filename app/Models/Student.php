<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $guarded =[];
 //each student have one parent
    public function parent(){
        return $this->belongsTo(Parente::class,'parent_id', 'id');
    }

    public function class(){
        return $this->hasOne(Classroom::class, 'class_id', 'id');
    }

    public function matiere(){
        return $this->hasMany(Matiere::class);
    }
}
