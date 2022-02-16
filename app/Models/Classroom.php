<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    
    protected $guarded =[];

    public function student(){
        return $this->hasMany(Student::class, 'student_id', 'id');
    }

    public function level(){
        return $this->hasOne(Level::class, 'level_id', 'id');
    }
}
