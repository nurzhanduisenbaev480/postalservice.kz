<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    private $user_id;

    public function __construct()
    {
        //dd(\Auth::user()->getRole(\Auth::user()->id)->first()->role_id);
        if (!is_null(\Auth::user())){
            if (\Auth::user()->getRole(\Auth::user()->id)->first()->role_id == 5){
                return redirect()->route('front.index');
            }
        }
    }

    public function setUserId(){
        $this->user_id = Auth::user()->id;
    }
    public function getUserId(){
        return $this->user_id;
    }
}
