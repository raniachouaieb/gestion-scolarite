<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    
    
    protected $guarded =[];

    public function class(){
        return $this->hasMany(Classroom::class, 'classroom_id', 'id');
    }
}

