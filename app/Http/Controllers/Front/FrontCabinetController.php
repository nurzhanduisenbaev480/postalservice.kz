<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\User;
use App\Models\UserInfo;

class FrontCabinetController extends Controller
{
    public function index()
    {
        $cities = City::get();
        $title = 'Добавить накладной';
        $user = User::find(\Auth::user()->id);
        //dd(\Auth::user()->id);
        $userInfo = UserInfo::where('user_id', $user->id)->get()->first();
		//dd($userInfo);
        $company = Company::find($userInfo->company_id);
        //dd($cities);
        return view('front.overhead.index', compact('cities', 'title', 'user', 'company', 'userInfo'));
    }
}
