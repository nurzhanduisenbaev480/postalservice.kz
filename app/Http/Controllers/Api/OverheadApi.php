<?php


namespace App\Http\Controllers\Api;


use App\Models\City;
use App\Models\Overhead;
use Illuminate\Support\Facades\Request;

class OverheadApi extends \App\Http\Controllers\Controller
{
    public function getOverheadById(Request $request){

        if (isset($_GET) && !empty($_GET)){
            $overhead_id = $_GET['overhead_id'];
            $overhead = Overhead::find($overhead_id);
            if (strlen($overhead->from_city) < 3){
                $overhead->from_city = City::find($overhead->from_city)->city_name;
            }
            if (strlen($overhead->to_city) < 3){
                $overhead->to_city = City::find($overhead->to_city)->city_name;
            }
            return json_encode(['success'=>1, 'overhead'=>$overhead]);
        }

        return json_encode(['success'=>0]);
    }
}
