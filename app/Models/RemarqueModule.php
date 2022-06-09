<?php

namespace App\Models;

use App\BaseModel;
use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class RemarqueModule extends BaseModel
{
    use SoftDeletes;
    protected $table = "remarques";
    protected $fillable = [
        'value',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function moduleMoyennes()
    {
        return $this->hasMany(moduleMoyenne::class);
    }


}

