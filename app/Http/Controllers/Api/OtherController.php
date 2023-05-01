<?php


namespace App\Http\Controllers\Api;


use App\Models\Order;
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

class OtherController extends \App\Http\Controllers\Controller
{
	public function getClientsByName(){
		//dd($_GET);
		DB::enableQueryLog();
		$search = $_GET['from_name'];
		
		$search = mb_convert_encoding($search, "utf-8", "Windows-1251");
		//$search = mb_convert_encoding($search, 'Windows-1252', 'UTF-8');
		$search = mb_convert_encoding($search, 'Windows-1251', 'UTF-8');
		//$search = iconv('utf-8//IGNORE', 'cp1252//IGNORE', $search);
		//$search = iconv('cp1251//IGNORE', 'utf-8//IGNORE', $search);
		//echo $search;


		//$users =  User::query()->where('user_type', 2)->where('name', 'LIKE', "%".$search."%")->get();
		$users = DB::table('users')->where('name','LIKE','%'.$search.'%')->where('user_type', 2)->get();
		$companies = DB::table('companies')->where('company_name', 'LIKE','%'.$search.'%')->get();
		//print_r($users);
		//dd($users);
		//dd(DB::getQueryLog());
		$data = [];
		$i=0;
		foreach($companies as $company){
			$data[$i] = [
				"id"=> $company->id,
				"name"=> User::find($company->user_id)->name,
				"email"=> User::find($company->user_id)->email,
				"address"=>UserInfo::where('user_id', $company->user_id)->get()->first()->address,
				"phone"=>UserInfo::where('user_id', $company->user_id)->get()->first()->phone,
				"company"=>$company->company_name,
				"city"=>City::find(UserInfo::where('user_id', $company->user_id)->get()->first()->city_id)->city_name,
			];
			$i++;
		}
		
		/*
		foreach($users as $user){
			$data[$i] = [
				"id"=> $user->id,
				"name"=> $user->name,
				"email"=> $user->email,
				"visible_password"=> $user->visible_password,
				"address"=>UserInfo::where('user_id', $user->id)->get()->first()->address,
				"phone"=>UserInfo::where('user_id', $user->id)->get()->first()->phone,
				"company"=>Company::find(UserInfo::where('user_id', $user->id)->get()->first()->company_id)->company_name,
				"company"=>City::find(UserInfo::where('user_id', $user->id)->get()->first()->city_id)->city_name,
			];
			$i++;
		}*/
		
		return json_encode(['success'=>$data]);
	}
	public function sendMessage(){
			
			
		$data = [
			"from_name"=>$_GET['from_name'],
			"from_phone"=>$_GET['from_phone'],
			"from_email"=>$_GET['from_email'],
			"description"=>$_GET['description']
		];
		//return json_encode($data);
		
		Mail::send(['text'=>'mail'], ["data"=>$data], function($message){
			if(isset($_GET))
			{
				$from_name 		=$_GET['from_name'];
				$from_phone 	=$_GET['from_phone'];
				$from_email 	=$_GET['from_email'];
				$description 	=$_GET['description'];
			}
			$message->to("nurzhanduisenbaev480@mail.ru", "To Transit Trade")->subject("Обратный звонок для заказа");
			$message->from($from_email, $from_name);
		});
		
		return json_encode(['success'=>2]);
	}
	
	public function getNotifications(){
	//	Overhead::orderBy('id', 'DESC')->skip($skip)->take($offset)->get();
		$notifications = Notification::where('readed', 1)->orderBy('id', 'DESC')->take(30)->get();
		$data = [];
		foreach($notifications as $notification){
			$data[] = [
				'id'=>$notification->id,
				'item_id'=>$notification->item_id,
				'type'=>$notification->type,
			];
		}
		
		return json_encode(['notifications'=>$data]);
	}
	
	
}
