<?php


namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Company;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserInfo;
use App\Models\Status;
use App\Models\Order;
use App\Models\Overhead;
use App\Models\Notification;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class CheckerController extends \App\Http\Controllers\Controller
{
    /**
     * OverheadController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	
	
	public function update(){
		//return json_encode($_POST);
		if(isset($_POST) && !empty($_POST)){
			$overhead_id = $_POST['overhead_id'];
			$value = $_POST['value'];
			$to_name = $_POST['to_name'];
			$to_company = $_POST['to_company'];
			$to_city = $_POST['to_city'];
			$to_address = $_POST['to_address'];
			$to_phone = $_POST['to_phone'];
			
			$type = $_POST['type'];
			$speed = $_POST['speed'];
			$payment = $_POST['payment'];
			$payment_type = $_POST['payment_type'];
			//return json_encode($_POST);
			
			$overhead = Overhead::find($overhead_id)
				->update([
					'to_name' => $to_name,
					'to_company' => $to_company,
					'to_city' => $to_city,
					'to_address' => $to_address,
					'to_phone' => $to_phone,
					
					'type' => $type,
					'speed' => $speed,
					'payment' => $payment,
					'payment_type' => $payment_type,
				]);
			if($overhead){
				return json_encode(['success'=>1]);
			}else{
				return json_encode(['success'=>0]);
			}
		}else{
			return json_encode(['success'=>3]);
		}
		
	}
	
	public function search(){
		if(isset($_GET['code'])){
			$code = $_GET['code'];
			$overhead = Overhead::where('overhead_code', $code)->get()->first();
			
			if($overhead === null){
				//dd($overhead);
				
				$user = $_GET["user"];
				$code = $_GET["code"];
				//return json_encode($_GET);
				//return json_encode($_GET['user']);
				$over = Overhead::create([
					'overhead_code' =>$code,
					'spi'           => "CHN".$code,
					'from_name'     =>$user['fromName'],
					'from_company'  =>$user['fromCompany'],
					'from_city'     =>$user['fromCity'],
					'from_address'  =>$user['fromAddress'],
					'from_phone'    =>$user['fromPhone'],
					'author'        =>1,
					'created_at'    => date("Y-m-d H:i:s"),
					'updated_at'    => date("Y-m-d H:i:s"),
					'status_id'     => 1,
					'date_s'    => date("Y-m-d H:i:s"),
					'date_e'	=> null,
					'checker'	=> 1
				]);
				if($over){
					$journal = Journal::create([
						'overhead_code'=>$code,
						'status_name'=>'Новый',
						'shpi_code'=>"CHN".$code,
						'status_id'=>1,
						'is_active'=>1,
						'date'=> date("Y-m-d H:i:s"),
					]);
					return json_encode(["success"=>1]);
				}else{
					return json_encode(["success"=>0]);
				}
			}else{
				return json_encode(["success"=>3]);
			}
			
		}
		
		return json_encode($_GET);
	}
	
	public function index(){
		//$from = date("Y-m-d 00:00:00");
		//$to = date("Y-m-d 23:59:59");
		$statuses = Status::get();
		
		$userRoles = UserRole::where('role_id', 5)->get();
		$ids = [];
		foreach($userRoles as $item){
			$ids[] = $item->user_id;
		}
		$users = User::whereIn('id', $ids)->get();
		$users2 = User::where('user_type', 2)->get();
		$userInfos = UserInfo::whereIn('user_id', $ids)->get();
		
		$userData = [];
		$ind = 0;
		foreach($userInfos as $item){
			$userData[$ind] = [
				'user_id' => $item->id,
				'from_name' => User::find($item->user_id)->name,
				'from_company' => Company::find($item->company_id)->company_name,
				'from_city'=>$item->city_id,
				'from_address'=>$item->address,
				'from_phone'=>$item->phone,
			];
			$ind++;
		}
		//dd($userData);
		//dd($userInfos);
		$overheads = Overhead::where('checker', 1)->orderBy('id', 'DESC')->get();
		
		$cities = City::get();
		//dd($overheads);
		return view('admin.checker.index', compact('overheads', 'statuses', 'userInfos', 'cities', 'userData'));
	}
	
    
	public function delete(){
		if(isset($_GET)){
			$overhead_id = $_GET['overhead_id'];
			
			$overhead= Overhead::find($overhead_id)->update([
				'checker'=> 0,
			]);
			
			if($overhead){
				return redirect()->back();
			}
		}
	}
	
}
