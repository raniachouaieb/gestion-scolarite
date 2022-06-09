<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RemarqueModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RemarqueModuleController extends Controller
{

    public function index(Request $request)
    {
        $data = RemarqueModule::query()->orderBy('created_at', 'desc');
        $name = $request->query('s');
        if ($name) {
            $data->where('value', 'like', '%' . $name . '%');
            $data->orderBy('value', 'asc');
        }
            $rows = $data->paginate(10);

        return view('dashboard.remarqueModule.index',compact('rows'))->withTitle(__( 'Recommended remarks'))->withName(__('Remark'));
    }

    public function create(Request $request)
    {
        $row = new RemarqueModule();


        return view('dashboard.remarqueModule.detail', compact('row'))->withTitle( $row->id ? __('Edit remark: ').$row->name : __('Add new remark'))->withName(__('Remark'));
    }

    public function edit(Request $request, $id)
    {
        $row = RemarqueModule::find($id);
        if (empty($row)) {
            return redirect(route('remarqueModule.admin.index'))->with('error', __('Not found!'));
        }

        return view('dashboard.remarqueModule.detail', compact('row'))->withTitle( $row->id ? __('Edit remark: ').$row->name : __('Add new remark'));
    }

    public function store(Request $request, $id)
    {
        if ($id and $id > 0) {
            $row = RemarqueModule::find($id);
            if (empty($row)) {
                return redirect(route('remarqueModule.admin.index'))->with('error', __('Not found!'));
            }
            $request->validate([
                'value' => 'required|max:255',
            ]);
        } else {
            $check = Validator::make($request->input(), [
                'value' => 'required|max:255',
            ]);
            if ($check->fails()) {
                return back()->withErrors($check)->withInput($request->input());
            }
            $row = new RemarqueModule();
        }
        $row->value = $request->input('value');
        if ($row->save()) {
            return back()->with('success', ($id and $id > 0) ? __('Remark updated') : __("Remark created"));
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

                $query = RemarqueModule::where("id", $id)->first();
                if (!empty($query)) {
                    $query->delete();
                    foreach ($query->moduleMoyennes as $moduleMoyenne) {
                        $moduleMoyenne->remarque_note_id = null;
                        $moduleMoyenne->save();
                    }
                }
            }
        }
        return redirect()->back()->with('error', __('Deleted Successfully!'));
    }

    public function delete(Request $request, $id)
    {
        $query = RemarqueModule::where("id", $id)->first();
        if (!empty($query)) {
            $query->delete();
            foreach ($query->moduleMoyennes as $moduleMoyenne) {
                $moduleMoyenne->remarque_note_id = null;
                $moduleMoyenne->save();
            }
        }
        return redirect()->back()->with('error', __('Deleted Successfully!'));
    }
}

