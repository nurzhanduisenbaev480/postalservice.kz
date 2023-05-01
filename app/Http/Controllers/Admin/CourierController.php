<?php


namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Order;
use App\Models\Overhead;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CourierController extends \App\Http\Controllers\Controller
{
    /**
     * CourierController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $orders = Order::where('courier_id', Auth::user()->id)
            ->where(function ($query){
                $query->where('status_id','=', 2)->orWhere('status_id','=', 3)->orWhere('status_id','=', 4);
            })->get();
        return view('admin.courier.index', compact('orders'));
    }

    public function accept(){
        $order_id = $_GET['order_id'];
        $orders = Order::where('courier_id', Auth::user()->id)
            ->where(function ($query){
                $query->where('status_id','=', 2)->orWhere('status_id','=', 3)->orWhere('status_id','=', 4);
            })->get();
        $order = Order::where('id', $order_id)->update([
            'status_id'=>3
        ]);
        return redirect()->route('admin.courier.index', compact('orders'));
        //dd($_GET);
    }

	public function take4(){
		$order_id = $_GET['order_id'];
		$overhead_codes = json_decode($_GET['data']);
		//return json_encode(['success'=>0]);
		if (count($overhead_codes) > 0){
            foreach($overhead_codes as $overhead_code){
                $overhead = Overhead::where('overhead_code')->update([
                    'status_id'     => 4,
                ]);
                $journal = Journal::create([
                    'overhead_code'=>$overhead_code,
                    'status_name'=>'Курьер забрал',
                    'shpi_code'=>"CHN".$overhead_code,
                    'status_id'=>4,
                    'is_active'=>1,
                    'date'=> date("Y-m-d H:i:s"),
                ]);
            }
        }
		$order = Order::where('id', $order_id)->update([
            'status_id'=>4,
            'date_s'=>date("Y-m-d H:i:s"),
        ]);
		/*
		$journal = Journal::create([
                'overhead_code'=>$overhead_code,
				'status_name'=>'Новый',
				'shpi_code'=>"CHN".$overhead_code,
                'status_id'=>1,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
		*/
		return json_encode(['success'=>1, 'overhead_codes'=>$overhead_codes]);
	}

	public function take3(){
        $order_id = $_GET['order_id'];
		$overhead_code = $_GET['overhead_code'];
		$user_id = $_GET['user_id'];
        $order = Order::find($order_id);
		$overhead = Overhead::where('overhead_code', $overhead_code)->get()->first();
		if(is_null($overhead)){
			$overhead2 = Overhead::create([
                'overhead_code' =>$overhead_code,
				'order_id'		=> $order_id,
                'from_name'     =>$order->from_name,
                'from_company'  =>$order->from_company,
                'from_city'     =>31,
                'from_address'  =>$order->from_address,
                'from_phone'    =>$order->from_phone,
                'type'          =>"Посылка",
                'speed'         =>"Стандарт",
                'payment'       =>"Отправителем",
                'payment_type'  =>"По счету",
                'description'   =>$order->description,
                'author'        =>$user_id,
				'courier_id'	=> $user_id,
				'date_s'		=> date("Y-m-d H:i:s"),
                'status_id'     => 1,
            ]);
			$journal = Journal::create([
                'overhead_code'=>$overhead_code,
				'status_name'=>'Новый',
				'shpi_code'=>"CHN".$overhead_code,
                'status_id'=>1,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
			if(!is_null($overhead2)){
				return json_encode(['success'=>1, 'overhead_code'=>$overhead2->overhead_code]);
			}
		}else{
			$overhead3 = Overhead::where('overhead_code', $overhead_code)
            ->update([
                'order_id'		=> $order_id,
				'courier_id'	=> $user_id,
            ]);
			return json_encode(['success'=>1, 'overhead_code'=>$overhead_code]);
		}


    }
	public function take2(){
        $order_id = $_GET['order_id'];
        $order = Order::find($order_id);
		$overheads = Overhead::where('order_id', $order_id)->get();
		//dd($overheads);
        return view('admin.courier.take2', compact('order', 'overheads'));
    }
    public function take(){
        $order_id = $_GET['order_id'];
        $orders = Order::where('courier_id', Auth::user()->id)
            ->where(function ($query){
                $query->where('status_id','=', 2)->orWhere('status_id','=', 3)->orWhere('status_id','=', 4);
            })->get();
        $order = Order::where('id', $order_id)->update([
            'status_id'=>4,
            'date_s'=>date("Y-m-d H:i:s"),
        ]);
        return redirect()->route('admin.courier.index', compact('orders'));
    }
    public function finish(){
        $order_id = $_GET['order_id'];
        $orders = Order::where('courier_id', Auth::user()->id)
            ->where(function ($query){
                $query->where('status_id','=', 2)->orWhere('status_id','=', 3)->orWhere('status_id','=', 4);
            })->get();
        $order = Order::where('id', $order_id)->update([
            'status_id'=>14,
            'courier_id'=>null
        ]);
        return redirect()->route('admin.courier.index', compact('orders'));
    }
    public function myOverhead(){
        $overheads = Overhead::where('courier_id', Auth::user()->id)->where('check',1)->get();
        return view('admin.courier.overhead', compact('overheads'));
    }

    public function editOverhead(){
        $overhead_id = $_GET['overhead_id'];
        $overhead = Overhead::find($overhead_id);
        $user = Auth::user();
        $cities = City::get();
        return view('admin.courier.edit', compact('overhead', 'user', 'cities'));
    }

    public function update(Request $request){

        $overhead_id    = $request->overhead_id;
        $user_id        = $request->user_id;
        $overhead_code  = $request->overhead_code;

        $from_name      = $request->from_name;
        $from_company   = $request->from_company;

        $from_city      = $request->from_city;
        $from_city_name = City::find($from_city)->city_name;

        $from_phone     = $request->from_phone;
        $from_address   = $request->from_address;

        $to_name      = $request->to_name;
        $to_company   = $request->to_company;

        $to_city      = $request->to_city;
        $to_city_name = City::find($to_city)->city_name;

        $to_phone     = $request->to_phone;
        $to_address   = $request->to_address;

        $type           = $request->type;
        $speed          = $request->speed;
        $payment        = $request->payment;
        $payment_type   = $request->payment_type;
        //dd($request);
        $mass           = $request->mass;
        $length         = $request->length;
        $width          = $request->width;
        $height         = $request->height;

        $description    = $request->description;
        if ($from_name == null || $from_address == null || $from_phone == null){
            Session::put('message', 0);
            return redirect()->route('admin.orders.create');
        }

        $order = Overhead::where('id', $overhead_id)
            ->update([
                'overhead_code'    =>$overhead_code,
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
                'mass'          =>$mass,
                'length'        =>$length,
                'width'         =>$width,
                'height'        =>$height,
                'check'         =>2,
                'status_id'     => 1,
                'updated_at'    => date("Y-m-d H:i:s"),
            ]);
        if ($order){
            Session::put('message', 2);
            return redirect()->route('admin.courier.edit', ['overhead_id'=>$overhead_id]);
        }else{
            Session::put('message', 1);
            return redirect()->route('admin.courier.edit', ['overhead_id'=>$overhead_id]);
        }
    }
}
