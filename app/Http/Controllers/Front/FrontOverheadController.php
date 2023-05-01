<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Journal;
use App\Models\Overhead;
use Illuminate\Http\Request;

class FrontOverheadController extends Controller
{
    public function index()
    {
        $cities = City::get();
        //dd($cities);
        $title = 'Список накладных';
        return view('front.overhead.index', compact('cities', 'title'));
    }

    public function list(){
        $title = 'Список накладных';
        $overheads = Overhead::where('author', \Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('front.overhead.list', compact('overheads', 'title'));
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
            $data['author'] = \Auth::user()->id;
//            $data['date_e'] = date('Y-m-d H:i:s');
        }
//        dd($data);
        if (Overhead::insert($data)){
            $journal = Journal::create([
                'overhead_code'=>$data['overhead_code'],
                'status_name'=>'Новый',
                'shpi_code'=>"CHN".$data['overhead_code'],
                'status_id'=>1,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
            return redirect()->route('front.cabinet.index')->with(['success'=>'Заявка успешно добавлен']);
        }else{
            return redirect()->route('front.cabinet.index')->withErrors(['error'=>'Что то пошло не так']);
        }
        //dd();
    }
}
