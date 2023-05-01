<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Order;
use App\Models\Overhead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CabinetController extends Controller
{
    //

    public function overhead(){
//        $overheads = Overhead::where('author', Auth::user()->id)->get();
        //dd($this->getUserId());
        //dd(Auth::user()->id);
        $orders = Order::where('author', Auth::user()->id)->get();
        $overheads = Overhead::where('author', Auth::user()->id)->get();
        return view('admin.cabinet.index', compact('orders', 'overheads'));
    }

    public function create2(){
        $user = Auth::user();
        $role = $user->roles()->get()->first();
        //dd($role->get()->first());
        $cities = City::get();
        $userInfo = $user->info()->get()->first();
        $company = $user->company()->get()->first();
        $city=City::find($userInfo->city_id);
        $cityDef = City::find($userInfo->city_id);
        return view('admin.cabinet.create', compact('cityDef','cities','user', 'userInfo', 'role'));
    }
    public function create(){
        $user = Auth::user();
        $role = $user->roles()->get()->first();
        //dd($role->get()->first());
        $cities = City::get();
        $userInfo = $user->info()->get()->first();
        $company = $user->company()->get()->first();
        $city=City::find($userInfo->city_id);
        $cityDef = City::find($userInfo->city_id);

        if ($role->id === 5){
            return view('admin.overhead.create', compact('cityDef','cities','user', 'userInfo', 'role'));
        }

        return view('admin.overhead.create2', compact('cities','user', 'userInfo', 'role'));
    }

    public function store(Request $request){
//        $request
        // dd($request);
        $user_id    = $request->user_id;
        $overhead_code = $request->overhead_code;

        $from_name      = $request->from_name;
        $from_company   = $request->from_company;

        $from_city      = $request->from_city;
        if ($from_city == 0){
            $from_city_name = 'Алматы';
        }else{
            $from_city_name = City::find($from_city)->city_name;
        }
        //$from_city_name = City::find($from_city)->city_name;

        $from_phone     = $request->from_phone;
        $from_address   = $request->from_address;

        $to_name      = $request->to_name;
        $to_company   = $request->to_company;

        $to_city      = $request->to_city;
        $to_city_name = '';
        if ($to_city == 0){
            $to_city_name = 'Алматы';
        }else{
            $to_city_name = City::find($to_city)->city_name;
        }


        $to_phone     = $request->to_phone;
        $to_address   = $request->to_address;

        $type           = $request->type;
        $speed          = $request->speed;
        $payment        = $request->payment;
        $payment_type   = $request->payment_type;

        $mass           = $request->mass;
        $volume         = $request->volume;
        $length         = $request->length;
        $height         = $request->height;
        $width          = $request->width;
        $place          =$request->place;
        $date_s = $request->date_s;
        $date_e = $request->date_e;
        //dd($request);
        //dd($mass);
        $description    = $request->description;
        if ($from_name == null || $from_address == null || $from_phone == null){
            Session::put('message', 0);
            return redirect()->route('admin.overheads.create');
        }

        //dd($overhead_code);
//        $overhead_code = '100000';
        $over = substr($from_company, 0, 2);
        if ($overhead_code == 0) {
            $overhead_from_db = Overhead::lastOverhead();
            if ($overhead_from_db != null) {
                //$overhead_code = intval(substr($overhead_from_db,2));
                $overhead_code = intval($overhead_from_db->overhead_code) + 1;
                //$overhead_code = $over.($overhead_code + 1);
                //$overhead_code = $over.($overhead_code + 1);
            } else {
                $overhead_code = rand(100000, 999999);
                //$overhead_code = substr($from_company, 0, 2);
                //$overhead_code = substr($from_company, 3);
                //$overhead_code = strtoupper($overhead_code);

            }
        }
        //dd($overhead_code);
        $overhead = DB::table('overheads')->insert([
            [
                'overhead_code' =>$overhead_code,
                'from_name'     =>$from_name,
                'from_company'  =>$from_company,
                'from_city'     =>$from_city_name,
                'from_address'  =>$from_address,
                'from_phone'    =>$from_phone,
                'to_name'       =>$to_name,
                'to_company'    =>$to_company,
                'to_city'       =>$to_city_name,
                'to_address'    =>$to_address,
                'to_phone'      =>$to_phone,
                'type'          =>$type,
                'speed'         =>$speed,
                'payment'       =>$payment,
                'payment_type'  =>$payment_type,
                'description'   =>$description,
                'author'        =>$user_id,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
                'place'         =>$place,
                'mass'          => $mass,
                'volume'        => $volume,
                'length'        => $length,
                'width'         => $width,
                'height'        => $height,
                'status_id'     => 1,
                'date_s'    => date("Y-m-d H:i:s"),
                'date_e'    => date("Y-m-d H:i:s"),
            ]
        ]);

        if ($overhead){
            return redirect()->route('admin.cabinet.overhead');
        }else{
            Session::put('message', 1);
            return redirect()->route('admin.overheads.create');
        }
    }

    public function delete(){
        if (isset($_GET)){
            $overhead_id = $_GET['overhead_id'];
            DB::table('overheads')->where('id', $overhead_id)->delete();
            return redirect()->route('admin.cabinet.overhead');
        }
    }
}
