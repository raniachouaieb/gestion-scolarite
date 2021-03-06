<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;

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
    protected $casts=[
        'created_at', 'updated_at','deleted_at',
    ];

    public function classes(){
        return $this->hasMany(Classroom::class, 'id_level', 'id');
    }
}

