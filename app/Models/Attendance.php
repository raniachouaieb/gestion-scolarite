<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{

    use SoftDeletes;


    protected $fillable = [
       'student_id','date','emploi_id','status','raison','semester','heure_deb','heure_fin'
    ];

    public function schedule(){
        return $this->belongsTo('App\Models\Schedule','emploi_id');

    }
    public function etudiant(){
        return $this->belongsTo('App\Models\Student','student_id');

    }

}
