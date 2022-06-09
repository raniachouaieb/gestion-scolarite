<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Bulletin extends Model
{
    protected $table = "bulletins";
    protected $fillable = [
        'trimestre','path','status','moyenne','basicmoyenne','student_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

//    public function bulletinFile()
//    {
//        return $this->hasOne('App\Models\BulletinFile','bulletin_id','id');
//
//    }
    public function ttest(){
        return BulletinFile::find(1);
    }
    public static function  doGetListTrimesters(){
        $output = [];
        $output[0] = "1er trimestre";
        $output[1] = "2ème trimestre";
        $output[2] = "3ème trimestre";
        return $output;

    }


    /**
     * Validate model against rules
     */
    public static function  doValidate($input, $scenario,$id=null)
    {
        $rules = [];
        $messages = [];
        switch ($scenario)
        {
            case 'get':
                $rules = [
                    'user_id' => 'required|exists:users',
                ];
                $messages = [
                    'user_id.required' => 'required',
                    'user_id.exists' => 'exists',
                ];
                break;
            case 'detail':
                $rules = [
                    'student_id' => 'required|exists:students',
                ];
                $messages =  [
                    'student_id.required' => 'required',
                    'student_id.exists' => 'exists',
                ];
                break;

        }
        return Validator::make($input, $rules,$messages);
    }
}
