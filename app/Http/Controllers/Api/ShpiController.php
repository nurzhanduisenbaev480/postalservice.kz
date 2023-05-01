<?php


namespace App\Http\Controllers\Api;


use App\Models\Order;
use App\Models\Journal;
use App\Models\Overhead;
use App\Models\Notification;
use App\Models\Registry;
use App\Models\Transport;
use App\Models\TransportType;
use App\Models\User;
use App\Models\Status;
use App\Models\City;
use App\Models\Company;
use App\Models\UserInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Mail;

class ShpiController extends \App\Http\Controllers\Controller
{
	public function addOverhead(){
		if(isset($_GET) && !empty($_GET)){
			$code = '';
			if(isset($_GET['code']) && !empty($_GET['code'])){
				$code = $_GET['code'];
			}
			$user_id = 9;
			if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
				$user_id = $_GET['user_id'];
			}
			
			
			$from_name       = isset($_GET["from_name"]) ? $_GET["from_name"] : '';
            $from_company    = isset($_GET["from_company"]) ? $_GET["from_company"] : '';
            $from_city       = isset($_GET["from_city"])?$_GET["from_city"]:1;
            $from_address    = isset($_GET["from_address"])?$_GET["from_address"]:'';
            $from_phone      = isset($_GET["from_phone"])?$_GET["from_phone"]:'';

            $to_name         = isset($_GET["to_name"])?$_GET["to_name"]:'';
            $to_company      = isset($_GET["to_company"])?$_GET["to_company"]:'';
            $to_city         = isset($_GET["to_city"])?$_GET["to_city"]:1;
            $to_address      = isset($_GET["to_address"])?$_GET["to_address"]:'';
            $to_phone        = isset($_GET["to_phone"])?$_GET["to_phone"]:'';


            $type            = isset($_GET["type"])?$_GET["type"]:'Посылка';
            $speed           = isset($_GET["speed"])?$_GET["speed"]:'Стандарт';
            $payment         = isset($_GET["payment"])?$_GET["payment"]:'Отправителем';
            $payment_type    = isset($_GET["payment_type"])?$_GET["payment_type"]:'Наличными';

            $mass            = isset($_GET["mass"])?$_GET["mass"]:0;
            $place           = isset($_GET["place"])?$_GET["place"]:1;
            $description     = isset($_GET["description"])?$_GET["description"]:'';
			
			if(strlen($code) < 6){
				$overhead = Overhead::where('from_company', 'LIKE', '%ТОО "Silk Road city express"')->orderBy('id', 'DESC')->get()->first();

				$overhead_code = $overhead->overhead_code;
				if(strlen($overhead_code)>12){
					$result = intval(preg_replace("/[^,.0-9]/", '', $overhead_code))+1;
					//dd($result);
					$code = "JNTKZ0".$result."YQ";
					//dd($code);
				}
			}
			
			//dd($overhead->overhead_code);
            $shpi = "CHN".$code;
			
            $overhead = Overhead::create([
                'overhead_code' =>$code,
				'from_name'     =>$from_name,
				'spi'			=>$shpi,
				'from_company'  =>$from_company,
				'from_city'     =>$from_city,
				'from_address'  =>$from_address,
				'from_phone'    =>$from_phone,
				'to_name'       =>$to_name,
				'to_company'    =>$to_company,
				'to_city'       =>$to_city,
				'to_address'    =>$to_address,
				'to_phone'      =>$to_phone,
				'type'          =>$type,
				'speed'         =>$speed,
				'payment'       =>$payment,
				'payment_type'  =>$payment_type,
				'description'   =>$description,
				'author'        =>$user_id,
				'mass'          => isset($mass) ? $mass:0,
				'place'			=>1,
				'status_id'     => 1,
				'created_at'    => date("Y-m-d H:i:s"),
				'updated_at'    => date("Y-m-d H:i:s"),
				'date_s'    => date("Y-m-d H:i:s"),
				'date_e'    => null,
            ]);
			$journal = Journal::create([
                'overhead_code'=>$overhead->overhead_code,
				'shpi_code' => $shpi,
				'status_name'=>'Новый',
                'status_id'=>1,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
			return json_encode(['success'=>1,'overhead_code'=>$code, 'shpi_code'=>$shpi]);
		}
		
		
		return json_encode(['success'=>0, 'error'=>'Что-то пошло не так, Обратитесь к администратору сайта']);
    }
	
	public function getStatus(){
		if(isset($_GET) && !empty($_GET)){
			if(isset($_GET['shpi']) && !empty($_GET['shpi'])){
				$overhead = Overhead::where('spi', $_GET['shpi'])->get()->first();
				$data = [
					'shpi'=>$_GET['shpi'],
					'events' => []
				];
				
				$journals = Journal::where('shpi_code', $_GET['shpi'])->get();
				$statuses = [];
				$i = 0;
				foreach($journals as $journal){
					$statuses[$i]['status'] = $journal->status_name;
					//dd($statuses[$i]['status']);
					$statuses[$i]['date'] = $journal->date;
					$statuses[$i]['address'] = $overhead->to_address;
					$i++;
				}
				$data['events'] = $statuses;
				return json_encode($data);
			}
			if(isset($_GET['code']) && !empty($_GET['code'])){
				$overhead = Overhead::where('overhead_code', $_GET['code'])->get()->first();
				//dd($overhead);
				$data = [
					'code'=>$_GET['code'],
					'events' => []
				];
				
				$journals = Journal::where('overhead_code', $_GET['code'])->get();
				$statuses = [];
				$i = 0;
				//dd($journals);
				foreach($journals as $journal){
					$statuses[$i]['status'] = $journal->status_name;
					if(empty($journal->status_name) && strlen($journal->status_name) < 2){
						$statuses[$i]['status'] = Status::find($journal->status_id)->status_name;
					}
					$statuses[$i]['status_code'] = Status::find($journal->status_id)->status_code;
					//dd(empty($statuses[$i]['status']));
					$statuses[$i]['date'] = $journal->date;
					$statuses[$i]['address'] = $overhead->to_address;
					$i++;
				}
				$data['events'] = $statuses;
				return json_encode($data);
			}
		}
	}
	
	
	
	
}
