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
use DateTime;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RegionController extends \App\Http\Controllers\Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        return view('admin.region.index');
    }
	
	public function setStatus(Request $request){		
		$data = $request->except("_token");
		$overhead_id = $data["overhead_id"];
		$registry_id = $data["registry_id"];
		$status_id = $data["status_id"];
		$description = $data["description"];
		
		
		$status = Status::find($status_id);
		$overhead = Overhead::find($overhead_id);
		$registry = Registry::find($registry_id);
		$overhead->update([
			'description' => $description
		]);
		
		$journal = Journal::create([
			'overhead_code'=>$overhead->overhead_code,
			'shpi_code'=>"CHN".$overhead->overhead_code,
			'status_name'=>$status->status_name,
			'status_id'=>$status_id,
			'is_active'=>1,
			'date'=> date("Y-m-d H:i:s"),
		]);
		
		if($journal){
			return redirect()->back()->with(['success'=>'Успешно обновлен']);
		}
		//dd($data);
	}
	public function setStatuses(Request $request){
		//dd($request);
		$overheads_id = json_decode($request->except("_token")["overheads"]);
		foreach($overheads_id as $overhead_id){
			$overhead = Overhead::find($overhead_id);
			if(strlen($overhead->to_city) > 2)
				$city = $overhead->to_city;
			else if(City::find($overhead->to_city) != null)
				$city = City::find($overhead->to_city)->city_name;
			else{
				$city = "Не указан";
			}
			
			$journal = Journal::create([
				'overhead_code'=>$overhead->overhead_code,
				'shpi_code'=>"CHN".$overhead->overhead_code,
				'status_name'=>'На доставке '. $city,
				'status_id'=>18,
				'is_active'=>1,
				'date'=> date("Y-m-d H:i:s"),
			]);
		}		
		return json_encode(['success'=>true]);
	}
	public function list(Request $request){
		$registry = [];
		$overheads = "";
		//dd($_GET);
		if(isset($_GET)){
			if(isset($_GET['registry'])){
				$registry = json_decode($_GET['registry']);
				//dd($registry);
				$overheads = Overhead::where('registry_id', $registry->id)->get();
				
			}
		}
		//dd($overheads);
		return view('admin.region.list', compact('registry', 'overheads'));
	}
	
	public function getRegistry(Request $request){
		//dd($request);
		$code = $request->except('_token');
		$c = $code['code'];
		$registry = "";
		if(strlen($c) > 3){
			$registry = Registry::where('code', $c)->get()->first();
			//return redirect()->route('admin.region.list', ['registry'=>$registry]);
			return json_encode(['success'=>true, 'registry'=>$registry]);
		}else{
			return json_encode(['success'=>false]);
		}			
		return json_encode($c);
	}
}
