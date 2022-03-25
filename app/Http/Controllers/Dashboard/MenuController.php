<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
    }

    public function index(){
        $menu = Menu::all();

        return view ('dashboard.menu.list-menu', compact('menu'))->withTitle('Menu du semaine');
    }

    public function addMenu(){
        $menu = Menu::get();
        return view('dashboard.menu.create-menu', compact('menu'))->withTitle('Créer le menu du jour');

    }

    public function store(MenuRequest $request){
        try{
            $menu = new Menu;
            $menu->date= $request->date;
            $menu->menu=$request->menu;
            $menu->jour=$request->jour;
            if($request->hasfile('image')){

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('uploads/menus/', $filename);
                $menu->image= $filename;

            }
            $dataMenu = $menu->save();
            if($dataMenu){
                Session::flash('statuscode', 'success');
                return redirect()->route('menu.index')->with('status','menu est ajouté avec succes');

            }else{
                Session::flash('statuscode', 'error');
                return redirect()->route('menu.index')->with('status','Convocation est error');
            }
        }catch(\Exception $ex){
            return redirect()->route('menu.index')->with(['status'=>'Error']);

        }


    }

    public function edit(Request $request, $id){
        $menu = Menu::find($id);


        if(!$menu){
            Session::flash('statuscode', 'error');

            return redirect()->route('menu.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.menu.edit-menu',compact('menu'))->withTitle('Edition menu');
    }

    public function update(Request $request, $id){
        $menu = Menu::find($id);
        try{
            if(!$menu){
                Session::flash('statuscode', 'error');

                return redirect()->route('menu.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
            }

            $menu->date= $request->date;
            $menu->menu=$request->menu;
            $menu->jour=$request->jour;
            if($request->hasfile('image')){
                $destination = 'uploads/menus/'.$menu->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('uploads/menus/', $filename);
                $menu->image= $filename;
            }
          $MenuData=  $menu->update();

            if($MenuData) {
                Session::flash('statuscode', 'success');
                return redirect()->route('menu.index')->with(['status' => 'Modification avec succés']);
            }else

            Session::flash('statuscode', 'error');
            return redirect()->route('menu.index')->with('status','Convocation est error');

        }catch(\Exception $exception){
            Session::flash('statuscode', 'error');

            return redirect()->route('menu.index')->with(['status'=>'There is an error :(']);
        }


    }
}
