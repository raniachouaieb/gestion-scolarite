<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant_Module extends Model
{
    protected $table="enseaignant_module";

    protected $fillable = [
        'id','enseignant_id','module_id'
    ];

    protected $casts=[
        'updated_at','deleted_at','created_at'
    ];
}
