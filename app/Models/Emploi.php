<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    protected $table= 'emplois';
     protected $fillable=[
         'titre',
         'class_id',
         'niveau_id',
     ];

    protected $hidden=[
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function seances(){
        return $this->hasMany(\App\Models\Seance::class, 'emploi_id', 'id');
    }

    public function classe(){
        return $this->belongsTo(\App\Models\Classroom::class, 'class_id', 'id');
    }
}
