<?php

namespace App\Models;

use App\Models\Classroom_Info;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;

class Info extends Model
{

    protected $table='infos';

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



    public function classes()
    {
        return $this->belongsToMany(\App\Models\Classroom::class);
    }

    public function classe()
    {
        return $this->hasMany(Classroom_Info::class,'info_id','id')->orderByDesc('Created_at');

    }

}
