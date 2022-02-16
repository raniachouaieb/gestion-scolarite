<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function parent(){
        return $this->hasOne(Parent::class, 'parent_id', 'id');
    }
}
