<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Level;
use App\Models\Travail;
use App\Models\Emploi;
use App\Models\Info;

class Classroom extends Model
{
    protected $table='classerooms';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','id_level'
    ];

    public function student(){
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

    public function level(){
        return $this->hasOne(Level::class, 'id_level', 'id');
    }

    public function travails(){
        return $this->hasMany(Travail::class, 'class_id', 'id');
    }

    public function emplois(){
        return $this->hasMany(Emploi::class, 'class_id', 'id');
    }

    public function infos(){
        return $this->hasMany(Info::class);
    }
}
