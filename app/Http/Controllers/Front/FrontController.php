<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Journal;
use App\Models\Overhead;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index(){
        $title = 'Главная';
        return view('front.front_index', compact('title'));
    }
    public function add_overhead(){
        $cities = City::get();
        $title = 'Накладной';
        return view('front.pages.for_client', compact('cities', 'title'));
    }

    public function store(Request $request){
        $data = $request->except('_token');
//        $data['overhead_code'] = '';
        if(!isset($data['overhead_code'])){
            $overhead = Overhead::lastOverhead();
            //dd($overhead);

            if($overhead == null){
                $data['overhead_code'] = 100000;
            }else{
                $data['overhead_code'] = intval($overhead->overhead_code)+1;
            }
//            dd($data['overhead_code']);
            $data['date_s'] = date('Y-m-d H:i:s');
            $data['author'] = 3;
//            $data['date_e'] = date('Y-m-d H:i:s');
        }
//        dd($data);
        if (Overhead::insert($data)){
            $journal = Journal::create([
                'overhead_code'=>$data['overhead_code'],
                'status_name'=>'У отправителя',
                'shpi_code'=>"CHN".$data['overhead_code'],
                'status_id'=>1,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
            return redirect()->route('front.add.overhead')->with(['success'=>'Заявка успешно добавлен']);
        }else{
            return redirect()->route('front.add.overhead')->withErrors(['error'=>'Что то пошло не так']);
        }
    }
}
