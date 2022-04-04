<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;

class Info extends Model
{

    protected $table='Infos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre','info','class_id'
    ];

    protected $casts=[
        'created_at','updated_at','deleted_at'
    ];
    public function classes(){
        return $this->hasMany(Classroom::class);
    }
}
