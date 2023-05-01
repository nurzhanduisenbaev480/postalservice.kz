<?php


namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Transport;
use App\Models\Registry;
use App\Models\Order;
use App\Models\Overhead;
use App\Models\Journal;
use App\Models\Road;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GroupController extends \App\Http\Controllers\Controller
{
    /**
     * RoadController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $users = User::where('user_type', 1)->get();
        $userList = [];
		$registries = Registry::where('status_id', 1)->get();
        $cities = City::get();
        $transports = Transport::get();

        foreach ($users as $user){
            $role_id = $user->getRole($user->id)->first()->role_id;
            if ($role_id == 4){
                $userList[] = $user;
            }
        }
        $overheads = Overhead::where(function ($query){
            $query->where('status_id', 14)->orWhere('status_id', 16);
        })->get();
        //dd($overheads);s
        //dd($_GET);
        return view('admin.group.check2', compact('overheads', 'userList', 'transports', 'cities'));
    }
	public function setStatus(){
        $id = $_GET['id'];
		//dd(4);
        $overhead = Overhead::find($id);

        $o = $overhead->update([
            'status_id'=>'16',
			'check'=>'1',
        ]);
        return redirect()->route('admin.group.index');
    }
    public function create(Request $request){
        //dd(json_decode($request->registry_overheads));
		//dd($request);
        $overhead_ids = json_decode($request->registry_overheads);
        $type = $request->transport_type;
        $from = $request->from;
        $to = $request->to;
        $order_id = $request->order_id;
        $price = $request->price;
        $place = $request->place;
		$count = $request->count;
        //dd($type);
		if(empty($overhead_ids)){
			return redirect()->back()->with(['error'=>'Выберите наклданых']);
		}
		$registry_code = 100000;
        $last = Registry::lastRegistry();
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
            'check'=>3,
            'registry_id'=>$registry->id
        ]);
        $overheads = Overhead::where('registry_id', $registry->id)->get();
        foreach($overheads as $overhead1){
            $journal = Journal::create([
                'overhead_code'=>$overhead1->overhead_code,
                'status_id'=>15,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
        }
        return redirect()->back();
    }


}
