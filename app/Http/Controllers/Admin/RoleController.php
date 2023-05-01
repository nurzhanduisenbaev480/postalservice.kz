<?php


namespace App\Http\Controllers\Admin;


use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends \App\Http\Controllers\Controller
{
    /**
     * RoleController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $roles = Role::get();
        return view('admin.role.index', compact('roles'));
    }

    public function create(){
        $roles = Role::get();
        return view('admin.role.create', compact('roles'));
    }
    public function store(Request $request){
        //dd($request);
        $name = $request->name;
        $display_name = $request->display_name;
        $parent = $request->parent;

        $role = Role::create([
            'name'=>$name,
            'display_name'=>$display_name,
            'parent'=>$parent,
            'create_at'=>date("Y-m-d H:i:s"),
            'update_at'=>date("Y-m-d H:i:s")
        ]);
        if ($role){
            Session::put('message', 1);
            return redirect()->route('admin.roles.create');
        }
        return view('admin.role.store');
    }
}
