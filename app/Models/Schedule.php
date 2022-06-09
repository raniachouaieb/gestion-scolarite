<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $table = "schedules";
    protected $fillable = [
        'name', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday','saturday','status','level_id','classroom_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function attendance(){
        return $this->hasMany('App\Models\Attendance','emploi_id');

    }

    // Get Level for selected task


    public function level()

    {

        return $this->belongsTo(Level::class);

    }


    public function classroom()

    {

        return $this->belongsTo(Classroom::class);

    }


    public static function doGetListStatus()
    {

        $output = [];

        $output[0] = "en attente";

        $output[1] = "actif";


        return $output;

    }


    // helper method

    public static function doGetRuleValidation()

    {

        return

            [

                'name' => 'required',

                'status' => 'required',


            ];

    }


    public static function doGetMessagesValidation()

    {

        return

            [

                'name.required' => 'Ce champ est requis',

                'status.required' => 'Ce champ est requis',

            ];

    }


    public static function doCastModalFromRequest(\Illuminate\Http\Request $request)

    {

        if ($request->get('id') == null)

            $output = new Schedule();

        else

            $output = Schedule::find($request->get('id'));


        $output->name = $request->get('name');

        $output->status = $request->get('status');

        $output->level_id = $request->get('level_id');

        $output->classroom_id = $request->get('classroom_id');

        $lundi = $request->get('outer-list-lundi');
        if (isset($lundi)) {
            $out = array_values($lundi);
            $output->lundi = json_encode($out);
        } else {
            $output->lundi = "[]";
        }


        $mardi = $request->get('outer-list-mardi');
        if (isset($lundi)) {
            $out = array_values($mardi);

            $output->mardi = json_encode($out);
        } else {
            $output->mardi = "[]";
        }
        $mercredi = $request->get('outer-list-mercredi');
        if (isset($mercredi)) {
            $out = array_values($mercredi);

            $output->mercredi = json_encode($out);
        } else {
            $output->mercredi = "[]";
        }
        $jeudi = $request->get('outer-list-jeudi');
        if (isset($jeudi)) {
            $out = array_values($jeudi);

            $output->jeudi = json_encode($out);
        } else {
            $output->jeudi = "[]";
        }
        $vendredi = $request->get('outer-list-vendredi');
        if (isset($vendredi)) {
            $out = array_values($vendredi);

            $output->vendredi = json_encode($out);
        } else {
            $output->vendredi = "[]";
        }
        $samedi = $request->get('outer-list-samedi');
        if (isset($samedi)) {
            $out = array_values($samedi);

            $output->samedi = json_encode($out);
        } else {
            $output->samedi = "[]";
        }


        return $output;

    }


    public static function doSave(Schedule $data)

    {

        if ($data->id == null)

            $data->save();

        else

            $data->update();

        return $data;

    }
}
