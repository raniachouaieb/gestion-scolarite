<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Observation extends Model
{
    use SoftDeletes;
    protected $table = "observations";
    protected $fillable = [
        'valeur','trimester','student_id','lesson_id','obs'
    ];

    public function lesson()
    {
        return $this->belongsTo(Matiere::class,'lesson_id','id');
    }
    public function lessons()
    {
        return $this->belongsTo(Matiere::class);
    }
    public function student()
    {
        return $this->belongsTo('App\Models\Student','student_id','id');
    }


}
