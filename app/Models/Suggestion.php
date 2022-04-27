<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $table= 'suggestions';

    protected $fillable=[
        'sujet',
        'detail',
        'parent_id'
    ];

    protected $casts=[
        'created_at','deleted_at','updated_at'
    ];

    public function parent(){
        return $this->belongsTo('App\Models\Parente', 'parent_id','id');
    }
}
