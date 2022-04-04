<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $permissions = Permission::orderBy('id')->paginate(5);
        return view('dashboard.permission.index',compact('permissions'))->withTitle('liste des permissions');

    }

    public function add()
    {

        return view('dashboard.permission.create')->withTitle('Créer une permission');
    }

    public function store(Request $request)
    {

       try{
           $permissions = Permission::create([
               "name"=> $request->name,
           ]);
           if($permissions){
               Session::flash('statuscode', 'success');
               return redirect()->route('permissions', compact('permissions'))->with('status','La permission est ajoutée avec succées');
           }else
               Session::flash('statuscode', 'error');
           return redirect()->route('permissions')->with('status','Erreur');



       }catch(\Exception $ex){
           return redirect()->route('permissions')->with(['status'=>'Error']);

       }
    }

    public function edit(Request $request, $id){
        $permissions = Permission::find($id);
        if(!$permissions){
            return redirect()->route('permissions')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.permission.edit',compact('permissions'))->withTitle('Edition permission');
    }

    public function update(Request $request, $id){
        $permissionID = Permission::find($id);
        try{
            if(!$permissionID){
                return redirect()->route('permissions')->with(['error'=>'there is no data with this id, please enter a correct one']);
            }
            $permUpdated = $permissionID->update([
                'name'=>$request->name,

            ]);
            $permissionID->update($request->all());
            if($permUpdated && $request->all() === 'canceled'){
                Session::flash('statuscode', 'success');
                return redirect()->route('permissions')->with(['status'=>'nothing updateted']);
            }else{
                Session::flash('statuscode', 'success');
                return redirect()->route('permissions')->with(['status'=>'Modification avec succés']);
            }


        }catch(\Exception $exception){
            return redirect()->route('permissions')->with(['error'=>'There is a error :(']);
        }


    }

    public function destroy($id){
        $permissions = Permission::find($id);
        $permissions->delete();

        Session::flash('statuscode', 'error');
        return redirect()->route('permissions')->with('status','Cette permission est supprimée');
    }
}
