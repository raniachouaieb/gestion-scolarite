<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class moduleMoyenne extends Model

{

    use SoftDeletes;

    protected $table = "module_moyenne";
    protected $fillable = [
        'moyenne','trimestre','module_id','student_id','remarque_note_id','basicmoyenne'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function remarks()
    {
        return $this->belongsTo('App\Models\RemarqueModule');
    }

}

