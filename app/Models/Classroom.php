<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table='classerooms';
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function student(){
        return $this->hasMany(Student::class, 'student_id', 'id');
    }

    public function level(){
        return $this->hasOne(Level::class, 'level_id', 'id');
    }
}
