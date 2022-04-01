<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Emploi;
use App\Models\Matiere;
class Seance extends Model
{
    protected $table= 'seances';
    protected $fillable=[
        'start_time',
        'end_time',
        'day',
        'emploi_id',
        'matiere_id'
    ];

    protected $hidden=[
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function emploi(){
        return $this->belongsTo(Emploi::class,'emploi_id', 'id');

    }

    public function matiere(){
        return $this->belongsTo(Matiere::class,'matiere_id', 'id');

    }
}
