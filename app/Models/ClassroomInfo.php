<?php

namespace App\Models;

use App\Models\Info;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassroomInfo extends Model
{
    use SoftDeletes;

    protected $table="classroominfo";

    protected $fillable = [
        'id','classroom_id','info_id'
    ];

    protected $casts = ['deleted_at'];


    public function classe()
    {
        return $this->belongsTo(Info::class,'info_id','id');
    }
}
