<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use App\Http\Requests\ModuleRequest;;
use Illuminate\Support\Facades\Session;

class SuggestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {

        $listSuggestion = Suggestion::orderBy('created_at', 'DESC')->get();
        $parent= Suggestion::with('parent')->get();

        return view('dashboard.suggestion.list-suggestion', compact('listSuggestion','parent'))->withTitle('Liste des suggestions');
    }
}
