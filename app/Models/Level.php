<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level',
    ];

    public function class(){
        return $this->hasMany(Classroom::class, 'classroom_id', 'id');
    }
}

