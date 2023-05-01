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

class OrderApiController extends \App\Http\Controllers\Controller
{
	public function overStore(){
		//return json_encode(['success'=>3]);
        if(isset($_GET) && !empty($_GET)){
			$code = '';
			if(isset($_GET['code'])){
				$code = $_GET['code'];
			}
			if(isset($_GET['user_id']) || empty($_GET['user_id'])){
				$user_id = 1;
			}else{
				$user_id         = $_GET['user_id'];
			}
            
            $from_name       = $_GET["from_name"];
            $from_company    = $_GET["from_company"];
            $from_city       = $_GET["from_city"];
            $from_address    = $_GET["from_address"];
            $from_phone      = $_GET["from_phone"];

            $to_name         = $_GET["to_name"];
            $to_company      = $_GET["to_company"];
            $to_city         = $_GET["to_city"];
           
            
            $to_address      = $_GET["to_address"];
            $to_phone        = $_GET["to_phone"];


            $type            = $_GET["type"];
            $speed           = $_GET["speed"];
            $payment         = $_GET["payment"];
            $payment_type    = $_GET["payment_type"];

            $mass            = isset($_GET["mass"])?$_GET["mass"]:0;
            $place           = $_GET["place"];
            $description     = $_GET["description"];
			
			
			if(empty($code) || strlen($code) < 1){
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
			}else{
				$overhead_code = $code;
			}
            
			//return json_encode(['success'=>$_GET]);
            $overhead = Overhead::create([
                'overhead_code' =>$overhead_code,
				'from_name'     =>$from_name,
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
				'status_id'     => 4,
				'created_at'    => date("Y-m-d H:i:s"),
				'updated_at'    => date("Y-m-d H:i:s"),
				'date_s'    => date("Y-m-d H:i:s"),
				'date_e'    => null,
            ]);
			$journal = Journal::create([
                'overhead_code'=>$overhead->overhead_code,
                'status_id'=>1,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
			$journal = Journal::create([
                'overhead_code'=>$overhead->overhead_code,
                'status_id'=>4,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
			$notification = Notification::create([
				'type'=>'overhead',
				'item_id'=>$overhead->id,
				'created_at'=>date("Y-m-d H:i:s"),
				'updated_at'    => date("Y-m-d H:i:s"),
			]);
            return json_encode(['success'=>1, 'code'=>$overhead_code]);
        }
        return json_encode(['success'=>0]);
    }
	public function getClient2(){
		$users = User::where('user_type', 2)->get();
		//return json_encode($users);
		/*
		$userData["data"][0] = [
				'id'=>0,
				'roleId'=>0,
				'email'=>"",
				'password'=>"",
				'name'=>"",
				'city'=>"",
				'city_id'=>1,
				'phone'=>"",
				'company'=>"",
				'address'=>"",
				'bin'=>"",

			];*/
		foreach($users as $user){
			$user_role = DB::table('user_roles')->where('user_id', $user->id)->get()->first();
			$user_info = UserInfo::where('user_id', $user->id)->get()->first();
			$userData["data"][] = [
				'id'=>$user->id,
				'roleId'=>$user_role->role_id,
				'email'=>$user->email,
				'password'=>$user->visible_password,
				'name'=>$user->name,
				'city'=>City::find($user_info->city_id)->city_name,
				'city_id'=>$user_info->city_id,
				'phone'=>$user_info->phone,
				'company'=>Company::find($user_info->company_id)->company_name,
				'address'=>$user_info->address,
				'bin'=>Company::find($user_info->company_id)->company_bin,

			];
		}
		
		return json_encode($userData);
	}
	
	public function getClient(){
		$users = User::where('user_type', 2)->get();
		//return json_encode($users);
		$userData[0] = [
				'id'=>0,
				'roleId'=>0,
				'email'=>"",
				'password'=>"",
				'name'=>"",
				'city'=>"",
				'city_id'=>1,
				'phone'=>"",
				'company'=>"",
				'address'=>"",
				'bin'=>"",

			];
		foreach($users as $user){
			$user_role = DB::table('user_roles')->where('user_id', $user->id)->get()->first();
			$user_info = UserInfo::where('user_id', $user->id)->get()->first();
			$userData[] = [
				'id'=>$user->id,
				'roleId'=>$user_role->role_id,
				'email'=>$user->email,
				'password'=>$user->visible_password,
				'name'=>$user->name,
				'city'=>City::find($user_info->city_id)->city_name,
				'city_id'=>$user_info->city_id,
				'phone'=>$user_info->phone,
				'company'=>Company::find($user_info->company_id)->company_name,
				'address'=>$user_info->address,
				'bin'=>Company::find($user_info->company_id)->company_bin,

			];
		}
		
		return json_encode($userData);
		
	}
	
	public function acceptOrder(){
		if(isset($_GET) && !empty($_GET)){
			$order_id = $_GET['order_id'];
			$order = Order::find($order_id);
			$order->update([
				'status_id'=>3
			]);
			
			return json_encode(['success'=>true]);
		}
		return json_encode(['success'=>false]);
	}
	public function takeOrder(){
		if(isset($_GET) && !empty($_GET)){
			$order_id = $_GET['order_id'];
			$order = Order::find($order_id);
			$order->update([
				'status_id'=>4
			]);
			return json_encode(['success'=>true]);
		}
		return json_encode(['success'=>false]);
	}
	public function onStoreOrder(){
		if(isset($_GET) && !empty($_GET)){
			$order_id = $_GET['order_id'];
			$order = Order::find($order_id);
			$order->update([
				'status_id'=>5
			]);
			return json_encode(['success'=>true]);
		}
		return json_encode(['success'=>false]);
	}
	
}
