<?php


namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Order;
use App\Models\Overhead;
use App\Models\Journal;
use App\Models\Status;
use App\Models\Registry;
use App\Models\Transport;
use App\Models\Summary;
use App\Models\TransportType;
use App\Models\UserInfo;
use DateTime;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StoreController extends \App\Http\Controllers\Controller
{
    /**
     * StoreController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRegistry(Request $request){
        $registry = Registry::find($request->registry_id);
        $overheads = Overhead::where('registry_id', $registry->id)->get();
        $from = City::find($registry->from);
        $to = City::find($registry->to);
        $status = Status::find($registry->status_id);

        $transport = Transport::find($registry->transport_type);

        return view('admin.store.registryShow', compact('registry', 'overheads', 'to', 'from', 'status', 'transport'));
    }


	public function setStatus3(Request $request){
		$overhead_code = $request->overhead_code;
		$overhead  = Overhead::where('overhead_code', $overhead_code)->get()->first();
		if(!is_null($overhead)){
			$overhead->update([
				'check'=>3
			]);
			return json_encode(['success'=>1]);
		}
		return json_encode(['success'=>2]);
	}
	public function setStatus4(Request $request){
		return json_encode(['success'=>4]);
	}

	public function setStatus(){
		$registry_id = $_GET['registry_id'];
		$registry_status = $_GET['registry_status'];
		$status_name = Status::find($registry_status)->status_name;
		$registry = Registry::find($registry_id);

		$city = City::find($registry->to)->city_name;

		if($registry_status == 7 || $registry_status == 18){
			$status_name = $status_name." в г.".$city;
		}

		$overheads = Overhead::where('registry_id', $registry_id)->get();
		$data = [];
		$i=0;
		foreach($overheads as $overhead){
			$data[$i] = [
				'status_name'=>$status_name,
				'status_id'=>$registry_status,
				'overhead_code'=>$overhead->overhead_code,
				'shpi_code'=>"CHN".$overhead->overhead_code,
				'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
			];
			$i++;
		}
		//dd($data);
		$journal = Journal::insert($data);
		if($journal){
			//redirect
			return redirect()->back()->with('success', 'Статусы успешно обновлены');
		}
		return redirect()->back()->with('error', 'Ошибка');
	}
	public function getRegistry(){
		$registry_id = $_GET['registry_id'];
		$registry = Registry::find($registry_id);
		$transport = Transport::find($registry->transport_type);
		$data = [
			'price'=>isset($registry->price)?$registry->price:0,
			'transport_name'=>isset($transport->name)?$transport->name:"---",
		];
		//print_r($transport);
		return json_encode($data);
	}

    public function index(){
        $orders = Order::where('status_id', 5)->get();
        return view('admin.store.index', compact('orders'));
    }
    public function check(){
        $order_id = $_GET['order_id'];
        $order = Order::find($order_id);

        $overheads = Overhead::where('order_id', $order->id)->get();
        //dd($overheads);
        //dd($_GET);
        return view('admin.store.check', compact('order', 'overheads'));
    }
    public function update(){
        $id      = $_POST['id'];
        //$code    = $_POST['code'];
        $name    = $_POST['name'];
        $company = $_POST['company'];
        $city    = $_POST['city'];
        $address = $_POST['address'];
        $phone   = $_POST['phone'];
        $mass    = $_POST['mass'];
        $length  = $_POST['length'];
        $width   = $_POST['width'];
        $height  = $_POST['height'];
        $overhead = Overhead::where('id', $id)->update([
            'to_name'=>$name,
            'to_city'=>$city,
            'to_company'=>$company,
            'to_address'=>$address,
            'to_phone'=>$phone,
            'mass'=>$mass,
            'length'=>$length,
            'width'=>$width,
            'height'=>$height,
        ]);
        if ($overhead){
            return json_encode(['success'=>1]);
        }
        return json_encode(['success'=>0]);
    }
    public function checkOverhead(){
        $overheadCode   = $_GET['overhead'];
        $order_id       = $_GET['order_id'];
        $order           = Order::find($order_id);
        $overhead       = Overhead::where('overhead_code', $overheadCode)->get()->first();
        //dd($overhead);
        if ($overhead == null){
            //dd($overhead);
            $overhead = Overhead::create([
                'overhead_code'=>$overheadCode,
                'order_id'=>$order_id,
                'from_name'=>$order->from_name,
                'from_company'=>$order->from_company,
                'from_city'=>$order->from_city,
                'from_address'=>$order->from_address,
                'from_phone'=>$order->from_phone,
                'type'=>'',
                'speed'=>'',
                'payment'=>'',
                'payment_type'=>'',
                'author'=>$order->author,
                'date_s'=>date("Y-m-d H:i:s"),
                'date_e'=>date("Y-m-d H:i:s")
            ]);
        }else{
            $overhead = Overhead::where('overhead_code', $overheadCode)
                ->update([
                    'order_id'=>$order_id
                ]);
        }
        return json_encode($overhead);
    }
    public function registry3(){
        $order_id = $_GET['order_id'];
        $overheads = Overhead::where('order_id', $order_id)->where('check', 1)->get();
        $registries = Registry::where('order_id', $order_id)->where('status_id', '!=', 15)->get();
        $cities = City::where('city_zone', 1)->get();
        $transports = Transport::get();
        return view('admin.store.registry2', compact('transports','order_id', 'overheads', 'registries', 'cities'));
    }
    public function registry2(){
        //$order_id = $_GET['order_id'];
        $user = Auth::user();
        $userInfo = UserInfo::where('user_id', $user->id)->first();
        $from_city = City::find($userInfo->city_id);
        //$overheads = Overhead::where('status_id', 5)->where('check', 1)->get();
        //$overheads2 = Overhead::where('status_id', 5)->where('check', 2)->get();
		$overheads = Overhead::where('status_id', 5)->where('author', Auth::user()->id)
//            ->where('from_city', $from_city->id)
//            ->orWhere('from_city', $from_city->city_name)
            ->where('check', 3)->get();
		$overheads2 = Overhead::where('status_id', 5)->where('author', Auth::user()->id)
//            ->where('from_city', $from_city->id)
//            ->orWhere('from_city', $from_city->city_name)
            ->where('check', 4)->get();
        $registries = Registry::where('status_id', 1)->get();
        $cities = City::get();
        $transports = Transport::get();
        return view('admin.store.registry3', compact('transports', 'overheads','overheads2', 'registries', 'cities'));
    }
    public function createRegistry(){

        $data        = $_POST['data'];
        $registry_id = $_POST['registry_id'];

        if (!isset($data) || empty($data)){
            return json_encode(['success'=>false, 'message'=>'Накладные не выбраны']);
        }
        if (!isset($registry_id)){
            return json_encode(['success'=>false, 'message'=>'Создайте реестр']);
        }
        //return json_encode(count($data));
        foreach ($data as $item){
            Overhead::where('id', $item)->update([
                'registry_id'=>$registry_id,
                'check'=>2
            ]);
        }
        Registry::where('id', $registry_id)->update([
            'status_id'=>15,
            'date_s'=>date("Y-m-d H:i:s")
        ]);


        return json_encode(['success'=>true, 'message'=>'Успешно добавлен!!!']);
    }
    public function create(Request $request){
        //dd(json_decode($request->registry_overheads));
        $overhead_ids = json_decode($request->registry_overheads);
        $type = $request->transport_type;
        $from = $request->from;
        $to = $request->to;
        $order_id = $request->order_id;
        $price = $request->price;
        $place = $request->place;
		$count = $request->count;
        //dd($type);
		$registry_code = 100000;
        $last = Registry::orderBy('id', 'desc')->get()->first();//Registry::lastRegistry();
        if ($last != null){
            $registry_code = intval($last->code)+1;
        }
        $registry = Registry::create([
            'transport_type'=>$type,
            'code'=>$registry_code,
            'from'=>$from,
            'to'=>$to,
            'place'=>$place,
			'count'=>$count,
            'order_id'=>$order_id,
            'status_id'=>5,
            'date_s'=>date("Y-m-d H:i:s"),
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s")
        ]);
        Overhead::whereIn('id', $overhead_ids)->update([
            'status_id'=>15,
            'check'=>5,
            'registry_id'=>$registry->id
        ]);
        $overheads = Overhead::where('registry_id', $registry->id)->get();
        foreach($overheads as $overhead1){
            $journal = Journal::create([
                'overhead_code'=>$overhead1->overhead_code,
                'status_id'=>15,
				'status_name'=>'В пути '.City::find($to)->city_name,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
        }
        return redirect()->route('admin.store.registryList');
    }
    public function registryList(){
        $registries = Registry::where('status_id', 5)->where('created_at', '>=', date("Y-m-d"))
			->orderBy('id', 'DESC')
            ->get();
        $transports = Transport::get();
		$statuses = Status::get();
        return view('admin.store.registryList', compact('registries', 'transports'));
    }
	public function archive(){
		$registries = Registry::orderBy('id', 'DESC')->limit(200)
            ->get();
        $transports = Transport::get();
        return view('admin.store.archive', compact('registries', 'transports'));
	}

    public function getOverhead(){
        $registry_id = $_GET['registry_id'];
        $registry = Registry::find($registry_id);
        $transport = Transport::find($registry->transport_type);
        $transport_name = '';
        $transport_phone = '';
        if ($transport == null){
            $transport_name = 'Не установлен';
            $transport_phone = 'Не установлен';
            $transport_type = 'Не установлен';
        }else{
            $transport_name = $transport->name;
            $transport_phone = $transport->phone;
            $transport_type = TransportType::find($transport->type)->name;
        }

        $overheads = Overhead::where('registry_id', $registry_id)->get();
        $data = [];
        $over = [];
        $data = [
            'date'=>$registry->date_s,
            'from'=>City::find($registry->from)->city_name,
            'to'=>City::find($registry->to)->city_name,
            'name'=>$transport_name,
            'type'=>$transport_type,
            'phone'=>$transport_phone,
        ];
		//return json_encode($overheads);
        //return json_encode($data);
        //return json_encode($overheads);
        foreach ($overheads as $overhead){
            $day = 0;
			/*
            if ($overhead->speed == 'Стандарт'){

                $day += City::where('city_name',$overhead->to_city)->get()->first()->date_standart+5;
            }else{

                $day += City::where('city_name',$overhead->to_city)->get()->first()->date_express+3;

            }
			*/
            //return json_encode($day);
            $over[] = [
                'code'=>$overhead->overhead_code,
                'from_company'=>isset($overhead->from_company)?$overhead->from_company:"-------",
				'to_company'=>isset($overhead->to_company)?$overhead->to_company:"-------",
                'to_city'=>(City::find($overhead->to_city) != null)?City::find($overhead->to_city)->city_name:$overhead->to_city,
                'to_name'=>isset($overhead->to_name)?$overhead->to_name:"-------",
                'to_address'=>isset($overhead->to_address)?$overhead->to_address:"--------",
                'to_phone'=>isset($overhead->to_phone)?$overhead->to_phone:"------",
				'description'=>isset($overhead->description)?$overhead->description:"--------",
                'type'=>$overhead->type,
				'mass'=>$overhead->mass,
				'place'=>$overhead->place,
                'price'=>$overhead->price,
                'speed'=>$overhead->speed
            ];
        }
        //return json_encode($over);
        $data['overheads'] = $over;

        return json_encode($data);

    }

    public function updateRegistry(Request $request){
        //dd($request);
        $registry_id    = $request->registry_id2;
        //$status_id      = $request->status_id;
        $transport      = $request->transport;
        $date           = $request->date_s;
		$price = isset($request->price)?$request->price:0;
		//dd($registry_id);
        //dd($request);
        $registry = Registry::where('id', $registry_id)->get()->first();
        //dd($registry);
        $registry->update([
            'status_id'=>5,
            'price'=>$request->price,
            'transport_type'=>$transport,
            'date_s'=>$date ? $date : date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('admin.store.registryList');
    }
    public function updateRegistry2(Request $request){
        $registry_id    = $request->registry_id;
        //$status_id      = $request->status_id;
        $transport      = $request->transport;
        $date           = $request->date_s;
        $price = isset($request->price)?$request->price:0;
        //dd($registry_id);
        //dd($request);
        $registry = Registry::where('id', $registry_id)->get()->first();
        //dd($registry);
        $registry->update([
            'status_id'=>5,
            'price'=>$request->price,
            'transport_type'=>$transport,
            'date_s'=>$date ? $date : date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('admin.store.archive');
    }

    public function updateS(){
        $data = $_POST['ids'];
        Overhead::whereIn('id', $data)->update([
            'check'=>4
        ]);
        return json_encode($data);
    }
    public function updateE(){
        $data = $_POST['ids'];
        Overhead::whereIn('id', $data)->update([
            'check'=>3
        ]);
        return json_encode($data);
    }

    public function summary(){
        $user = Auth::user();
		//dd($user->id);
        $user_info = DB::table('user_infos')->where('user_id', $user->id)->get()->first();
        $from_city = City::find($user_info->city_id);

        //dd($from_city);
        $summaries = Summary::where('from_city', $from_city->id)->orWhere('to_city', $from_city->id)->orderBy('id', 'DESC')->get();
		//dd($summaries);
        //dd($summaries);
        $sum = [];
        foreach ($summaries as $summary){
            $registry = Registry::find($summary->registry_id);
            $transport = Transport::find($registry->transport_type);
            $sum[] = $summary;
        }
        //dd($sum);
        return view('admin.store.summary', compact('sum', 'summaries'));
    }

    public function sendSummary(Request $request){
        //dd($request);
        $registry_id = $request->registry_id2;
        $description = $request->description;
		$price = $request->price;
        $registry = Registry::find($registry_id);
		//dd($registry);
		$registry->update([
			'status_id' => 6,
		]);
        $summary = Summary::create([
            'registry_id'=>$registry_id,
            'description'=>$description,
            'from_city'=>$registry->from,
            'to_city'=>$registry->to,
            'status'=>"В пути в ".City::find($registry->to)->city_name,
            'date_start'=>date("Y-m-d H:i:s"),
            'date_end'=>date("Y-m-d H:i:s"),
			'price'=>$price
        ]);
        if($summary){
            $overheads = Overhead::where('registry_id', $registry->id)->get();
            foreach($overheads as $overhead1){
                $journal = Journal::create([
                    'overhead_code'=>$overhead1->overhead_code,
                    'status_id'=>7,
                    'is_active'=>1,
                    'date'=> date("Y-m-d H:i:s"),
                ]);
            }
            return redirect()->route('admin.store.registryList');
        }

    }
    public function getSummary(){
		//$summaries = Summary::get();
        $summaries = Summary::where('date_start', '>=', $_GET['start'])->where('date_start', '<=', $_GET['end'])->get();
        $data = [];
        foreach($summaries as $summary){
            $registry = Registry::find($summary->registry_id);
            $transport = Transport::find($registry->transport_type);
            $from = City::find($registry->from);
            $to = City::find($registry->to);
            $data[] = [
                'id'=>$summary->id,
                'status'=>$summary->status,
                'description'=>$summary->description,
                'driver'=>$transport->name,
                'from'=>$from->city_name,
                'to'=>$to->city_name,
                'price'=>$registry->price,
            ];
        }
        return json_encode($data);
    }

    public function showSummary(){
        //dd($_GET);
        $id = $_GET['id'];
        $summary = Summary::find($id);
        $from = City::find($summary->from_city);
        $to = City::find($summary->to_city);
        $registry = Registry::find($summary->registry_id);
        //dd($registry);
        $overheads = Overhead::where('registry_id', $registry->id)->get();
        return view('admin.store.showSummary', compact('summary', 'overheads', 'registry', 'from', 'to'));
    }
    public function yesOverhead(){
        //dd($_GET);
        $overhead = Overhead::find($_GET['id'])->update([
            'status_id'=>17,
        ]);
		$journal = Journal::create([
			'overhead_code'=>$overhead->overhead_code,
			'status_id'=>17,
			'is_active'=>1,
			'date'=> date("Y-m-d H:i:s"),
		]);
        $id = $_GET['summary_id'];
        $summary = Summary::find($id);
        $from = City::find($summary->from_city);
        $to = City::find($summary->to_city);
        $registry = Registry::find($summary->registry_id);
        //dd($registry);
        $overheads = Overhead::where('registry_id', $registry->id)->get();

        return redirect()->route('admin.store.showSummary', ['id'=>$id])->with(compact('summary', 'overheads', 'registry', 'from', 'to'));

    }
    public function getOverhead5(Request $request){
        $overhead = Overhead::where('overhead_code', $request->overhead_code)->first();
        if ($overhead != null){
            return json_encode(['success'=>1, 'overhead'=>$overhead]);
        }else{
            return json_encode(['success'=>0]);
        }
    }

}
