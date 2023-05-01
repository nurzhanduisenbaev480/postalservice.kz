<?php


namespace App\Http\Controllers;


use App\Models\Overhead;
use App\Models\Status;

class SearchController extends Controller
{
    public function search(){
        return view('out.search');
    }

    public function tracking(){
        $overhead_code = $_GET['overhead_code'];
        //return json_encode($overhead_code);
        $overhead = Overhead::where('overhead_code', trim($overhead_code))->get()->first();
        //return json_encode($overhead);
        $data = [
            'from_name'=>$overhead->from_name,
            'from_company'=>$overhead->from_company,
            'from_city'=>$overhead->from_city,
            'from_address'=>$overhead->from_address,
            'from_phone'=>$overhead->from_phone,
            'to_name'=>$overhead->to_name,
            'to_company'=>$overhead->to_company,
            'to_city'=>$overhead->to_city,
            'to_address'=>$overhead->to_address,
            'to_phone'=>$overhead->to_phone,
            'mass'=>$overhead->mass == null ? 0: $overhead->mass,
            'date_s'=>$overhead->date_s,
            'date_e'=>$overhead->date_e,
            'overhead_code'=>$overhead->overhead_code,
            'status'=>Status::find($overhead->getOrder($overhead->order_id)->status_id)->status_name
        ];
        return json_encode($data);
    }
}
