<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class NoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function add(Request $request)
    {
        $niveaux = Level::orderBy('created_at', 'ASC')->get();
        return view('dashboard.notes.create', compact('niveaux'))->withTitle('Insertion note');

    }
}
