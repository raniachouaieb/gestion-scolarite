<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Student;

class Convocation extends Model
{

    protected $table='convocations';

    const PAGINATION = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'titre_conv',
        'description',
        'date_envoie',
        'jour',
        'student_id',
    ];

    protected $hidden =[
        'created_at','deleted_at','updated_at',
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id', 'id');
    }


}
