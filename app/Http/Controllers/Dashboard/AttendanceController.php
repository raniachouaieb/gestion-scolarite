<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Level;
use App\Models\Module;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function index()
    {
        $date = date('d/m/Y');
        $niveaux = Level::orderBy('created_at', 'asc')->get();
        $breadcrumbs = [
            [
                'url' => route('attendance')
            ],
            [
                'class' => 'active'
            ],

        ];
        return view('dashboard.attendance.index', compact('breadcrumbs', 'niveaux', 'date'))->withTitle(__('Attendance'))->withName(__('Attendance'))->withNameBreadcrumbs(__("All"));
    }

    public function loadAttendance( $classroom_id = null)
    {
        $date = date('Y-m-d');
        $students = Student::where("class_id", "=", $classroom_id)->get();

        $rows = Schedule::where('classroom_id', $classroom_id)->where('status', 1)->get();
        $output = [];
        $emploi_id=0;Log::info($rows);
        foreach ($rows as $row) {

            $emploi_id = $row['id'];

            foreach (json_decode($row['monday'], true) as $seance) {
                if ($seance['date'] === $date) {
                    array_push($output, ["from" => $seance['from'], "to" => $seance['to']]);
                }
            }
            foreach (json_decode($row['tuesday'], true) as $tuesday) {
                    if ($tuesday['date'] === $date) {
                         array_push($output, ["from" => $tuesday['from'], "to" => $tuesday['to']]);                   }
                }
            }
        foreach (json_decode($row['wednesday'], true) as $wednesday) {
                     if ($wednesday['date'] === $date) {
                         array_push($output, ["from" => $wednesday['from'], "to" => $wednesday['to']]);
                     }
                 }

                 foreach (json_decode($row['thursday'], true) as $thursday) {
                     if ($thursday['date'] === $date) {
                         array_push($output, ["from" => $thursday['from'], "to" => $thursday['to']]);
                     }
                 }

                 foreach (json_decode($row['friday'], true) as $friday) {
                     if ($friday['date'] === $date) {
                         array_push($output, ["from" => $friday['from'], "to" => $friday['to']]);
                     }
                 }
                 foreach (json_decode($row['saturday'], true) as $saturday) {
                     if ($saturday['date'] === $date) {
                         array_push($output, ["from" => $saturday['from'], "to" => $saturday['to']]);
                     }
                 }




        return view("dashboard.attendance.loadSchedule", compact( 'date', 'output', 'classroom_id', 'students', 'rows', 'emploi_id'))->render();

    }

    public function store(Request $request)
    {
        $attendance = Attendance::create([
            'status' => $request->status,
            'date' => date('Y-m-d'),
            'semester' => $request->trimestre,
            'raison' => $request->raison,
            'emploi_id' => $request->emploi_id,
        ]);

        $message = array('msg' => 'Successfully Form Submit', 'status' => true);
        return response()->json($message);
    }


}
