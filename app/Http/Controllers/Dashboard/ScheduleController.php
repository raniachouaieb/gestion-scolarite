<?php


namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Level;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ScheduleController extends Controller

{


    public function index(Request $request)
    {

        $niveaux = Level::orderBy('created_at', 'ASC')->get();
      $breadcrumbs = [
                [
                    'url' => route('schedule.admin.index')
                ],
                [
                    'class' => 'active'
                ],

        ];
        return view('dashboard.schedule.index',compact('niveaux','breadcrumbs'))->withTitle(__('Schedules'))->withName(__('Time tables'))->withNameBreadcrumbs( __("All"));
    }

    public function list($class = null, $level_id= null)
    {
        // Grab all the classes
        $schedules = Schedule::where('classroom_id', $class)->where('level_id', $level_id)->paginate(PAGINATION);
        return view("dashboard.schedule.list_schedule", [
            'schedules' => $schedules,
            'class'=>$class,
            'niveau'=>$level_id,
            "status" => Schedule::doGetListStatus(),
        ])->render();
    }


    public function Show($id)

    {
      //  $this->checkPermission('ecole_schedule_show');
        $row = Schedule::find($id);

        if (empty($row)) {
            return redirect(route('schedule.admin.index'));
        }

        $output = [];
        $output[0] = isset($row->monday) ? count(json_decode($row->monday, true)) : 0;
        $output[1] = isset($row->tuesday) ? count(json_decode($row->tuesday, true)) : 0;
        $output[2] = isset($row->wednesday) ? count(json_decode($row->wednesday, true)) : 0;
        $output[3] = isset($row->thursday) ? count(json_decode($row->thursday, true)) : 0;
        $output[4] = isset($row->friday) ? count(json_decode($row->friday, true)) : 0;
        $output[5] = isset($row->saturday) ? count((array)json_decode($row->saturday, true)) : 0;

        $status = Schedule::doGetListStatus();
        $size = $output;
      $breadcrumbs = [
                [
                    'url' => route('schedule.admin.index')
                ],
                [
                    'class' => 'active'
                ],

        ];
        return view('dashboard.schedule.show', compact('status','breadcrumbs','row','size'))->withTitle(__('Schedules'))->withName(__('Time tables'))->withNameBreadcrumbs( __("Show schedule: #:id". $row->id));

    }

    public function create(Request $request, $classroom_id,$level_id)
    {
        //$this->checkPermission('ecole_schedule_create');


        $row = new  Schedule();

        $level = Level::where('id', $level_id)->first();
        $classroom = Classroom::where('id', $classroom_id)->first();


        $status = Schedule::doGetListStatus();
      $breadcrumbs = [
                [
                    'url' => route('schedule.admin.index')
                ],
                [
                'class' => 'active'
                ]
        ];
        return view('dashboard.schedule.create', compact('classroom','level','breadcrumbs','row','status'))->withTitle(__($row->id ? 'Edit: '.$row->title : 'Add new time table'))->withName(__('Time tables'))->withNameBreadcrumbs( __("Add new"));
    }

    public function edit(Request $request, $id)
    {


        $row = Schedule::find($id);
        if (empty($row)) {
            return redirect(route('schedule.admin.index'));
        }
            $classroom = $row->classroom;
            $level = $row->level;
            $status = Schedule::doGetListStatus();

        return view('dashboard.schedule.create', compact('row','classroom','level','status'))->withTitle(__($row->id ? 'Edit: '.$row->name : 'Add new time table'))->withName(__('Time tables'));
    }

    protected function getRules(){
        return $validation=[
            'name' => 'required',
            'level_id' => 'required',
            'classroom_id' => 'required',
            'status' => 'required',

        ];
    }
    protected function getMessages(){
        return $message=[
            'name.required' => 'Name is required',
            'level_id.required' => 'Level is required',
            'classroom_id.required' => 'Classroom is required',
            'status.required' => 'Status is required',

        ];
    }
    public function create1(){
        return view('dashboard.schedule.create2');
    }
    public function store(Request $request, $id)
    {
        $validation = $this->getRules();
        $message = $this->getMessages();

       // dd($request);
        $check= $this->validate($request,$validation,$message);

        if ($id and $id > 0) {
            $row = Schedule::find($id);
            if (empty($row)) {
                abort(404);
            }

        } else {

            if (!$check) {
                return back()->withInput($request->input());
            }
            $row = new Schedule();
        }
        //$row = new Schedule();

        $row->name = $request->get('name');
        $row->status = $request->get('status');
        $row->level_id = $request->get('level_id');
        $row->classroom_id = $request->get('classroom_id');
        $lundi = $request->get('outer-list-lundi');
        if (isset($lundi)) {
            $out = array_values($lundi);
            foreach ($out as $key => $item) {
                if ($item["name"] === null) {
                    unset($out[$key]);
                }
            }

            $row->monday = json_encode($out);

        } else {
            $row->monday = "[]";
        }

        $mardi = $request->get('outer-list-mardi');
        if (isset($mardi)) {
            $out = array_values($mardi);
            foreach ($out as $key => $item) {
                if ($item["name"] === null) {
                    unset($out[$key]);
                }
            }
            $row->tuesday = json_encode($out);
        } else {
            $row->tuesday = "[]";
        }
        $mercredi = $request->get('outer-list-mercredi');
        if (isset($mercredi)) {
            $out = array_values($mercredi);
            foreach ($out as $key => $item) {
                if ($item["name"] === null) {
                    //unset destroy the $out
                    unset($out[$key]);
                }
            }
            $row->wednesday = json_encode($out);
        } else {
            $row->wednesday = "[]";
        }
        $jeudi = $request->get('outer-list-jeudi');
        if (isset($jeudi)) {
            $out = array_values($jeudi);
            foreach ($out as $key => $item) {
                if ($item["name"] === null) {
                    unset($out[$key]);
                }
            }
            $row->thursday = json_encode($out);
        } else {
            $row->thursday = "[]";
        }
        $vendredi = $request->get('outer-list-vendredi');
        if (isset($vendredi)) {
            $out = array_values($vendredi);
            foreach ($out as $key => $item) {
                if ($item["name"] === null) {
                    unset($out[$key]);
                }
            }
            $row->friday = json_encode($out);
        } else {
            $row->friday = "[]";
        }
        $samedi = $request->get('outer-list-samedi');
        if (isset($samedi)) {
            $out = array_values($samedi);
            foreach ($out as $key => $item) {
                if ($item["name"] === null) {
                    unset($out[$key]);
                }
            }
            $row->saturday = json_encode($out);
        } else {
            $row->saturday = "[]";
        }


        if ($row->save()) {
            return redirect()->back()->with('success', ($row->id and $row->id > 0) ? __('Schedule updated') : __("Schedule created"));
        }
    }


    public function bulkEdit(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids))
            return redirect()->back()->with('warning', __('Select at leas 1 item!'));
        if (empty($action))
            return redirect()->back()->with('warning', __('Select an Action!'));
        if ($action == 'delete') {
            foreach ($ids as $id) {
                $this->checkPermission('ecole_schedule_delete');

                $query = Schedule::where("id", $id)->first();
                if (!empty($query)) {
                    $query->delete();
                }
            }
        }
        return redirect()->back()->with('error', __('deleted Successfully!'));
    }
    public function delete(Request $request,$id)
    {
       // $id = $request->input('id');
        $query = Schedule::where("id", $id)->first();
        if (!empty($query)) {
            $query->delete();
        }
        return redirect()->back()->with('error', __('deleted Successfully!'));
    }
}

