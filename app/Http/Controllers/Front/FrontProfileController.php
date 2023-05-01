<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;

class FrontProfileController extends Controller
{
    public function index()
    {
        $title = 'Профиль';
        $user = \Auth::user();
        $user_info = UserInfo::where('user_id', $user->id)->get()->first();
        return view('front.profile.index', compact('user', 'user_info', 'title'));
    }
}
