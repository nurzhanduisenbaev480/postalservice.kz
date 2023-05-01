<?php


namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Order;
use App\Models\Tarif;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends \App\Http\Controllers\Controller
{
    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $newOrders          = Order::where('status_id', 1)->get();
        $takenOrders        = Order::where('status_id', 2)->orWhere('status_id', 3)->orWhere('status_id', 4)->get();
        $inStoreOrders      = Order::where('status_id', 5)->get();
        $inProcessOrders    = Order::where('status_id', 6)->orWhere('status_id', 7)->orWhere('status_id', 8)->get();
		$orders = Order::get();

        return view('admin.order.index', compact('newOrders', 'takenOrders', 'inProcessOrders', 'inStoreOrders', 'orders'));
    }

    public function create(){


        $user = Auth::user();
        $role = $user->roles()->get()->first();
        //dd($role->get()->first());
        $cities = City::get();
        $userInfo = $user->info()->get()->first();
        $company = $user->company()->get()->first();
        $city=City::find($userInfo->city_id);
        //dd($city);

        return view('admin.order.create', compact('cities','user', 'userInfo', 'role'));

    }
    public function store(Request $request){
        $user_id    = $request->user_id;
        //dd($request);
        $from_name      = $request->from_name;
        $from_company   = $request->from_company;

        $from_phone     = $request->from_phone;
        $from_address   = $request->from_address;

        $description    = $request->description;
        if ($from_name == null || $from_address == null || $from_phone == null){
            Session::put('message', 0);
            return redirect()->route('admin.orders.create');
        }

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
                'from_address'  =>$from_address,
                'from_phone'    =>$from_phone,
                'description'   =>$description,
                'author'        =>$user_id,
                'status_id'     =>1,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ]
        ]);

        if ($order){
            return redirect()->route('admin.roads.order');
        }else{
            Session::put('message', 1);
            return redirect()->route('admin.orders.create');
        }

    }
    public function show(){
        $order_id = 0;
        if (!empty($_GET)){
            $order_id = $_GET['order_id'];
        }else{
            return view("admin.order.index");
        }
        $order = Order::find($order_id);

        return view("admin.order.show", compact('order', 'order_id'));
    }
    public function edit(){
        $order_id = $_GET['order_id'];
        $order = Order::find($order_id);
        $user = Auth::user();
        $role = $user->roles()->get()->first();
        //dd($role->get()->first());
        $cities = City::get();
        $userInfo = $user->info()->get()->first();
        $company = $user->company()->get()->first();
        $city=City::find($userInfo->city_id);
        //dd($city);

        return view('admin.order.edit', compact('cities','user', 'userInfo', 'role', 'order'));
    }
    public function update(Request $request){
        //dd($request);
        $order_id   = $request->order_id;
        $user_id    = $request->user_id;
        $order_code = $request->order_code;

        $from_name      = $request->from_name;
        $from_company   = $request->from_company;

        $from_phone     = $request->from_phone;
        $from_address   = $request->from_address;


        $description    = $request->description;
        if ($from_name == null || $from_address == null || $from_phone == null){
            Session::put('message', 0);
            return redirect()->route('admin.orders.create');
        }

        $order = Order::where('id', $order_id)
            ->update([
                'order_code'    =>$order_code,
                'from_name'     =>$from_name,
                'from_company'  =>$from_company,

                'from_address'  =>$from_address,
                'from_phone'    =>$from_phone,
                'description'   =>$description,
                'author'        =>$user_id,
                'status_id'     =>1,
                'updated_at'    => date("Y-m-d H:i:s"),
            ]);
        if ($order){
            Session::put('message', 2);
            return redirect()->route('admin.orders.edit', ['order_id'=>$order_id]);
        }else{
            Session::put('message', 1);
            return redirect()->route('admin.orders.edit', ['order_id'=>$order_id]);
        }
    }

    public function contract(){
        $tarifs = Tarif::get();
        return view('admin.order.contract', compact('tarifs'));
    }

    public function contractList(){
        $user = Auth::user();
        $user_id = $user->id;
        $contracts = Contract::where('user_id', $user_id)->get();
        return view('admin.order.contractList', compact('contracts'));
    }

    public function contractCreate(Request $request){
        $user = Auth::user();
        $user_id = $user->id;
        $company_name = $request->company_name;
        $mass   = $request->mass;
        $price = $request->price;
        $price2= $request->price2;
        $price3= $request->price3;
        $contract_no = $request->contract_no;
        $speed = $request->speed;
        $contract = Contract::create([
            'company_name' => $company_name,
            'mass'=>$mass,
            'price'=>$price,
            'price2'=>$price2,
            'price3'=>$price3,
            'contract_id'=>$contract_no,
            'user_id'=>$user_id,
            'speed'=>$speed
        ]);
        if($contract){
            return redirect()->route('admin.orders.contractList');
        }
    }
}
