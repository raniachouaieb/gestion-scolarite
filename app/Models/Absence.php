<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Absence extends Model
{
    protected $table='absences';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_absence',
        'etat',
        'eleve_id'
    ];

    protected $casts=[
        'created_at','updated_at','deleted_at'
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'eleve_id', 'id');
    }




}
