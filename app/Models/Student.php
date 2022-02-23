<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $guarded =[];

    public function parent(){
        return $this->hasOne(Parent::class, 'parent_id', 'id');
    }

    public function class(){
        return $this->hasOne(Classroom::class, 'classroom_id', 'id');
    }
}
