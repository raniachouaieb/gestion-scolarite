<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $table='matieres';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nom',
        'coefficient',
        'module_id',
        'created_at','deleted_at','updated_at',
    ];

    public function student(){
        return $this->hasMany(Student::class);
    }

    public function module(){
        return $this->hasOne(Module::class , 'module_id', 'id');
    }

}
