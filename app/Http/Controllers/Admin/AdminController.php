<?php


namespace App\Http\Controllers\Admin;


class AdminController extends \App\Http\Controllers\Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //dd(\Auth::user());
        if (!is_null(\Auth::user())){
            if (\Auth::user()->getRole(\Auth::user()->id)->first()->role_id == 5){
                return redirect()->route('front.index');
            }else{
                return view('admin.admin');
            }
        }else{
            return view('admin.admin');
        }

    }
}
