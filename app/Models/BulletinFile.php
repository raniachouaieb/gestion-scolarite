<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BulletinFile extends Model
{
    use SoftDeletes;

    protected $table = "bulletins_files";
    protected $fillable = [
        'id', 'file_name', 'file_path', 'file_extension','bulletin_id','file_type','file_width','file_height'
    ];

    public function bulletin()
    {
        return $this->belongsTo(Bulletin::class,'bulletin_id','id');
    }
}
