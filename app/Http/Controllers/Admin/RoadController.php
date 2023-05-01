<?php


namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\History;
use App\Models\Order;
use App\Models\Overhead;
use App\Models\Journal;
use App\Models\Road;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RoadController extends \App\Http\Controllers\Controller
{
    /**
     * RoadController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orderSave(Request $request){
        $data = $request->except('_token');
        $order = Order::find($data['order_id']);
        $order->update($data);
        return back()->with(['message' => 0]);
    }

    public function orderShow(Request $request){
        $order = Order::find($request->order_id);
        $user = Auth::user();
        //$courier = User::find($order->courier_id);
        return view('admin.road.orderShow', compact('order', 'user'));
       // dd($request);
    }
    public function orderDelete(Request $request){
        $order = Order::find($request->order_id);
        $order->delete();
        return back()->with(['message'=>0]);
//        dd($request);
    }

    public function index(){
        $users = User::where('user_type', 1)->get();
        $roads = Road::get();
        $userList = [];
        //dd($users);
        foreach ($users as $user){
            $role_id = $user->getRole($user->id)->first()->role_id;
            //dd($user->getRole($user->id));
            if ($role_id == 2){
                //dd($user);
                $userList[] = $user;
            }
        }
        //dd($userList);
        return view('admin.road.index', compact('userList', 'roads'));
    }

	public function backList(){
		return redirect()->route('admin.roads.order');
	}

	public function addConnect(Request $request){
		$overhead = Overhead::where('overhead_code', $request->overhead_code)->get()->first();
		//dd($request->order_id);
		$order = Order::find($request->order_id);
		if(is_null($overhead)){
			$overhead = DB::table('overheads')->insert([
				[
					'overhead_code' =>$request->overhead_code,
					'order_id'		=> $request->order_id,
					'spi'           => "CHN".$request->overhead_code,
					'from_name'     =>$order->from_name,
					'from_company'  =>$order->from_company,
					'from_city'     =>31,
					'from_address'  =>$order->from_address,
					'from_phone'    =>$order->from_phone,
					'type'          =>'Посылка',
					'speed'         =>'Стандарт',
					'payment'       =>'Отправителем',
					'payment_type'  =>'По счету',
					'description'   =>$order->description,
					'author'        =>Auth::user()->id,
					'courier_id'	=> $order->courier_id,
					'created_at'    => date("Y-m-d H:i:s"),
					'updated_at'    => date("Y-m-d H:i:s"),
					'place'			=> 1,
					'mass'          => 0,
					'volume'        => 0,
					'length'        => 0,
					'width'         => 0,
					'height'        => 0,
					'status_id'     => 1,
					'date_s'    => date("Y-m-d H:i:s"),
					'date_e'	=> date("Y-m-d H:i:s"),

				]
			]);
			return redirect()->back()->with(['success'=>'Накладной присвоен и добавлен в базу!!!']);
		}else{
			$overhead->update([
				'order_id' => $request->order_id,
			]);

			return redirect()->back()->with(['success'=>'Накладной присвоен!!!']);
		}

	}
	public function disconnect(Request $request){
		$overhead = Overhead::where('overhead_code', $request->overhead_code)->get()->first();
		//dd($request->order_id);
		if(is_null($overhead)){
			return json_encode(['success'=>0]);
		}else{
			$overhead->update([
				'order_id' => 0,
			]);

			return redirect()->back()->with(['success'=>'Накладной успешно отстранен!!!']);
		}
	}


    public function connect(Request $request){
        $order = Order::find($request->order_id);
		$overheads = Overhead::where('order_id', $order->id)->get();
		//dd($overheads);
        return view('admin.road.connect', compact('order', 'overheads'));
    }

	public function order(){
        $newOrders      = Order::where('status_id', 1)->get(); // Новый заявка
        $courierInstall = Order::where('status_id', 2)->get(); // Курьер назначен
        $courierAccept  = Order::where('status_id', 3)->get(); // Курьер принял
        $courierTake    = Order::where('status_id', 4)->get(); // Курьер забрал
        $users = User::where('user_type', 1)->get();
        $roads = Road::get();
        $userList = [];

        foreach ($users as $user){
            $role_id = $user->getRole($user->id)->first()->role_id;
            if ($role_id == 2){
                $userList[] = $user;
            }
        }
        return view('admin.road.order', compact('userList','newOrders', 'courierInstall', 'courierAccept', 'courierTake'));
    }

    public function courier_status1(Request $request){
        $order = Order::find($request->id);
        $order->update([
            'status_id' => 3
        ]);
        return redirect()->back()->with(['success'=>'Успешно обновлен']);
        //dd($request);
    }
    public function courier_status2(Request $request){
        $order = Order::find($request->id);
        $order->update([
            'status_id' => 4
        ]);
        return redirect()->back()->with(['success'=>'Успешно обновлен']);
        //dd($request);
    }
    public function courier_status3(Request $request){
        $order = Order::find($request->id);
        $order->update([
            'status_id' => 5
        ]);
        return redirect()->back()->with(['success'=>'Успешно обновлен']);
        //dd($request);
    }


    public function setCourier(Request $request){
        //dd($request);
        $orderId = $request->order_id;
        $courier_id = $request->courier_id;
		//return json_encode(['success'=>1, 'gg'=>2]);
        $order = Order::where('id', $orderId)
            ->update([
                'courier_id'=>$courier_id,
                'status_id'=>2
            ]);

        if ($order){
            return redirect()->route('admin.roads.order');
        }
        return redirect()->route('admin.roads.order');
    }

    public function store(Request $request){
        $name = $request->name;
        $courier_id = $request->courier_id;
        $road = Road::create([
            'name'=>$name,
            'user_id'=>$courier_id,
        ]);
        return redirect()->route('admin.roads.index');
        //dd($request);
    }


    public function another(){
        $orders = Order::where('status_id', 14)->get();
        return view('admin.road.another', compact('orders'));
    }

    public function create(){
        $user = Auth::user();
        $role = $user->roles()->get()->first();
        //dd($role->get()->first());
        $cities = City::get();
        $userInfo = $user->info()->get()->first();
        $company = $user->company()->get()->first();
        return view('admin.road.create', compact('user', 'role', 'cities', 'userInfo', 'company'));
    }
    public function storeOrder(Request $request){
        $user_id    = $request->user_id;

        $from_name      = $request->from_name;
        $from_company   = $request->from_company;

        $from_city      = $request->from_city;
        $from_city_name = City::find($from_city)->city_name;

        $from_phone     = $request->from_phone;
        $from_address   = $request->from_address;

        $order_code = '100000';
        $order_from_db = Order::lastOrder();
        if($order_from_db != null){
            $order_code = intval($order_from_db->order_code) + 1;
        }


        $order = DB::table('orders')->insert([
            [
                'order_code'    =>$order_code,
                'from_name'     =>$from_name,
                'from_company'  =>$from_company,
                'from_city'     =>$from_city_name,
                'from_address'  =>$from_address,
                'from_phone'    =>$from_phone,
                'author'        =>$user_id,
                'status_id'     =>14,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ]
        ]);

        if ($order){
            return redirect()->route('admin.roads.another');
        }else{
            Session::put('message', 1);
            return redirect()->route('admin.roads.create');
        }

    }
    public function check(){

        $users = User::where('user_type', 1)->get();
        $userList = [];

        foreach ($users as $user){
            $role_id = $user->getRole($user->id)->first()->role_id;
            if ($role_id == 4){
                $userList[] = $user;
            }
        }
        $overheads = Overhead::where(function ($query){
            $query->where('status_id', 5)->where('check', 1)->where('author', Auth::user()->id);
        })->orderBy('id', 'DESC')->get();
        //dd($overheads);
        //dd($_GET);
        return view('admin.road.check2', compact('overheads', 'userList'));
    }
    public function check2(){

        $order_id = $_GET['order_id'];
        $order = Order::find($order_id);
        $users = User::where('user_type', 1)->get();
        $roads = Road::get();
        $userList = [];

        foreach ($users as $user){
            $role_id = $user->getRole($user->id)->first()->role_id;
            if ($role_id == 4){
                $userList[] = $user;
            }
        }
        $overheads = Overhead::where('order_id', $order->id)->where('status_id', 5)->get();
        //dd($overheads);
        //dd($_GET);
        return view('admin.road.check', compact('order', 'overheads', 'userList'));
    }

    public function save(){
        $order_id = $_GET['order_id'];
        $order = Order::find($order_id);

    }

    public function send(){
        $order_id = $_GET['order_id'];
        $order = Order::where('id',$order_id)->update([
            'status_id'=>5
        ]);
        return redirect()->route('admin.roads.another');
    }
    public function setCourier2(Request $request){
        //dd($request);
        $order_id = $request->order_id;
        $overhead_id = $request->overhead_id;
        $courier_id = $request->courier_id;
        $mass = $request->mass;
        $height = $request->height;
        $length = $request->length;
        $width = $request->width;

        $order = Overhead::where('id', $overhead_id)
            ->update([
                'courier_id'=>$courier_id,
                'mass'=>$mass,
                'width'=>$width,
                'height'=>$height,
                'length'=>$length
            ]);

        if ($order){
            return redirect()->route('admin.roads.check', ['order_id'=>$order_id]);
        }
        return redirect()->route('admin.roads.check');
    }
    public function checkOverhead(){
        $overheadCode   = $_GET['overhead'];

        $user = Auth::user();
		$overhead       = Overhead::where('overhead_code', $overheadCode)->get()->first();
        $over = $overhead;

        if($overhead != null){
            $overhead = Overhead::where('overhead_code', $overheadCode)
                    ->update([
                        'status_id'=>5,
                        'check'=>1,
                        'author' => Auth::user()->id,
                    ]);
            $journal = Journal::create([
                'overhead_code'=>$overheadCode,
				'shpi_code'=>"CHN".$overheadCode,
				'status_name'=>'На складе',
                'status_id'=>5,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
            $history = History::create([
                'user_id' => Auth::user()->id,
                'overheads_id'=>$over->id
            ]);
            return json_encode(['error'=>0]);
        }else{
            return json_encode(['error'=>1]);
        }


    }

    public function show(){

        $user  = Auth::user();
        $user_id = $user->id;
        $role = $user->roles()->get()->first();
        $overhead_id = $_GET['id'];
        $overhead = Overhead::find($overhead_id);
        $cities = City::get();
        return view('admin.road.show', compact('overhead', 'cities', 'role'));
    }

    public function setStatus(){
        $id = $_GET['id'];
		//dd(4);
        $overhead = Overhead::find($id);

        $o = $overhead->update([
            'status_id'=>'5',
			'check'=>'1',
        ]);
        return redirect()->route('admin.roads.check');
    }
	public function setStatus2(){
        $ids = $_GET['overhead_ids'];

		if(count($ids) > 1){
			$overheads = Overhead::whereIn('id', $ids)->update([
				'status_id'=>'5',
				'check'=>'2',
			]);
		}else{
			$overhead = Overhead::find($ids[0]);

			$o = $overhead->update([
				'status_id'=>'5',
				'check'=>'2',
			]);
		}
		return json_encode($ids);
		//dd($ids);

        //return redirect()->route('admin.roads.check');
    }
	public function setStatus3(){
        $ids = $_GET['overhead_ids'];
		//return json_encode($ids);
		if(count($ids) > 1){
			$overheads = Overhead::whereIn('id', $ids)->update([
				'status_id'=>'4',
				'check'=>'1',
			]);
		}else{
			$overhead = Overhead::find($ids[0]);

			$o = $overhead->update([
				'status_id'=>'4',
				'check'=>'1',
			]);
		}
		return json_encode($ids);
		//dd($ids);

        //return redirect()->route('admin.roads.check');
    }
	public function deleteOver(){
		$id = $_GET['id'];
		//dd(4);
        $overhead = Overhead::find($id);

        $o = $overhead->update([
            'status_id'=>'4',
			'check'=>'1',
        ]);
        return redirect()->route('admin.roads.check');
	}

	public function edit1(){
		$overhead_id = $_GET['overhead_id'];
		$overhead = Overhead::find($overhead_id);
		$user = Auth::user();
        $role = $user->roles()->get()->first();
        //dd($role->get()->first());
        $cities = City::get();
        $userInfo = $user->info()->get()->first();
        $company = $user->company()->get()->first();
        $city=City::find($userInfo->city_id);
        $cityDef = City::find($userInfo->city_id);
		//echo "Hello";
		return view('admin.road.edit1', compact('overhead', 'user', 'cities'));
	}

	public function update1(Request $request){
		$user_id = $request->user_id;
		$overhead_id = $request->overhead_id;
		$overhead_code = $request->overhead_code;
		$from_name = $request->from_name;
		$from_company = $request->from_company;
		$from_city = $request->from_city;
		$from_phone = $request->from_phone;
		$from_address = $request->to_address;
		$to_name = $request->to_name;
		$to_company = $request->to_company;
		$to_city = $request->to_city;
		$to_phone = $request->to_phone;
		$to_address = $request->to_address;
		$type = $request->type;
		$speed = $request->speed;
		$payment = $request->payment;
		$payment_type = $request->payment_type;
		$date_s = $request->date_s;
		$date_e = $request->date_e;
		$mass = $request->mass;
		$volume = $request->volume;
		$length = $request->length;
		$width = $request->width;
		$height = $request->height;

		$description = isset($request->description)?$request->description:"-----";
		$user = Auth::user();
        $role = $user->roles()->get()->first();
        //dd($role->get()->first());
        $cities = City::get();
		$overhead2 = Overhead::find($overhead_id)
			->update([
			"overhead_code" => $overhead_code,
			"from_name" => $from_name,
			"from_company" => $from_company,
			"from_city" => $from_city,
			"from_phone" => $from_phone,
			"from_address" => $from_address,
			"to_name" => $to_name,
			"to_company" => $to_company,
			"to_city" => $to_city,
			"to_phone" => $to_phone,
			"to_address" => $to_address,
			"type" => $type,
			"speed" => $speed,
			"payment" => $payment,
			"payment_type" => $payment_type,
			"date_s" => $date_s,
			"date_e" => $date_e,
			"description" => $description,
			"mass"=>$mass,
			"volume"=>$volume,
			"length"=>$length,
			"width"=>$width,
			"height"=>$height,

			]);
		if($overhead2){
			$overhead = Overhead::find($overhead_id);
			return redirect()->route('admin.roads.edit1', compact('overhead_id'));
		}else{
			return redirect()->route('admin.roads.check');
		}
	}


}
