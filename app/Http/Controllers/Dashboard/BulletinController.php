<?php


namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\BulletinFile;
use App\Models\Level;
use App\Models\Module;
use App\Models\RemarqueModule;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class BulletinController extends Controller

{
    public function indexpdf(Request $request, $id, $trimester)
    {
        $eleve = Student::findorfail($id);
        $modules = Module::where('level_id', $eleve->level_id)->get();

        return view('bulletin.testpdf', compact('eleve', 'trimester', 'modules'));
    }

    public function exportPdf(Request $request, $id, $trimester)
    {
        $eleve = Student::findorfail($id);

        $modules = Module::where('level_id', $eleve->level_id)->get();

        $breadcrumbs = [
            [
                'url' => route('bulletin.admin.index')
            ],
            [
                'class' => 'active'
            ],
        ];

        $pdf = PDF::loadView('bulletin.gradebookNote', compact('breadcrumbs', 'modules', 'eleve', 'trimester')); // <--- load your view into theDOM wrapper;
        $path = public_path('bulletins/'); // <--- folder to store the pdf documents into the server;
        $fileName = $eleve->nomEleve . ' ' . $eleve->prenomEleve . '.' . 'pdf'; // <--giving the random filename,
        $pdf->save($path . '/' . $fileName);
        $generated_pdf_link = url('bulletins/' . $fileName);

        return response()->json($generated_pdf_link);
        // return $pdf->download('pdfview.pdf');
    }

    public function index(Request $request)
    {
        $levels = Level::orderBy('created_at', 'asc')->get();

        return view('dashboard.bulletin.index', compact( 'levels'))->withTitle(__('Gradebook'))->withName(__('Gradebook'));
    }


    public function list($classroom_id = null, $niveau_id = null, $trimestre = null)
    {
        // Grab all the classes
        $eleves = Student::where('class_id', $classroom_id)->where('niveau', $niveau_id)->get();
        return view("dashboard.bulletin.list", [
            'eleves' => $eleves,
            'trimestre' => $trimestre
        ])->render();
    }


    public function edit(Request $request, $id, $trimester)
    {

        $eleve = Student::findorfail($id);
        $bulletin = Bulletin::where('student_id', $id)->where('trimestre', $trimester - 1)->first();
        $MoyenneBulletin = Bulletin::where('student_id', $id)->where('trimestre', $trimester)->first();
        $modules = Module::where('niveau_id', $eleve->niveau)->get();
        if ($bulletin == null) {
            $bulletin = new Bulletin();
            $bulletin->trimestre = $trimester - 1;
            $bulletin->path = "uploads/notfoundPath.jpg";
            $bulletin->status = 0;
        }
        $trimesters = Bulletin::doGetListTrimesters();



        return view('dashboard.bulletin.detail', compact( 'modules', 'eleve', 'bulletin', 'trimesters', 'trimester', 'MoyenneBulletin'))->withTitle(__('Edit: ' . $trimesters[$bulletin->trimestre]));
    }

    protected function getRules()
    {
        return $validation = [
            'trimester' => 'required|max:255',
            'status' => 'required',
            'student_id' => 'required',

        ];
    }

    protected function getMessages()
    {
        return $message = [
            'trimester.required' => 'Trimester is required',
            'status.required' => 'Status Name is required',
            'student_id.required' => 'Student is required',

        ];
    }

    public function store(Request $request, $id)
    {
        $validation = $this->getRules();
        $message = $this->getMessages();

        $check = $this->validate($request, $validation, $message);

        if ($id and $id > 0) {
            $row = Bulletin::find($id);
            if (empty($row)) {
                abort(404);
            }

        } else {

            if (!$check) {
                return back()->withInput($request->input());
            }
            $row = new Bulletin();
            $row->moyenne = 0;
            $row->basicmoyenne = 0;

        }

        $row->trimestre = $request->get('trimester');
        $row->status = $request->get('status');
        $row->student_id = $request->get('student_id');


        if ($row->save()) {
            $bulletinFile = BulletinFile::find($request->idfile);
            $bulletinFile->bulletin_id = $row->id;
            $bulletinFile->update();
            return back()->with('success', ($id and $id > 0) ? __('Bulletin updated') : __("Bulletin created"));
        }
    }
}

