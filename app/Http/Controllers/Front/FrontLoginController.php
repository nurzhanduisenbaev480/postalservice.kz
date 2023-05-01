<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FrontLoginController extends Controller
{
    public function auth(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);
        $user = User::where('email', $data['email'])->where('visible_password', $data['password'])->get()->first();
        //dd($user);
        if ($user){
            \Auth::login($user);
            return redirect()->route('front.cabinet.index');
        }
    }
    public function logout(){
        \Auth::logout();
        return redirect()->route('front.index');
    }
}
