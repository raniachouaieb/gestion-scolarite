<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{


    use SoftDeletes;

    protected $table = "notes";
    protected $fillable = [
        'note','trimestre','student_id','matiere_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function level()
    {
        return $this->belongsTo(Level::class);
    }




}
