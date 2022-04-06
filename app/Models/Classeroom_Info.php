<?php

namespace App\Models;

use App\Models\Info;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Classeroom_Info extends Model
{
    use SoftDeletes;

    protected $table="classeroom_info";

    protected $fillable = [
        'id','classeroom_id','info_id'
    ];

    protected $dates = ['deleted_at'];


    public function classe()
    {
        return $this->belongsTo(Info::class,'info_id','id');
    }
}
