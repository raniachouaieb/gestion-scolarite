<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Matiere;
use App\Models\Classroom;

class Travail extends Model
{
    protected $table = 'travails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'titre_travail',
        'detail_travail',
        'date_depot',
        'date_limite',
        'matiere_id',
        'class_id',
        'file',
        'extension',

    ];
    protected $hidden=[
        'created_at','deleted_at','updated_at',
    ];

    public function matiere(){
        return $this->hasMany(Matiere::class,'matiere_id', 'id');
    }
    public function class(){
        return $this->belongsTo(Classroom::class, 'class_id', 'id');
    }
}
