<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{protected $table="menus";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'date',
        'menu',
        'image ',
        'created_at','deleted_at','updated_at',
    ];
}
