<?php


namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Company;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClientController extends \App\Http\Controllers\Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function client_order(Request $request){
        $user = User::find($request->client_id);
        $user_info = UserInfo::where('user_id', $user->id)->get()->first();
        $company = Company::find($user_info->company_id);

        return view('admin.client.order', compact('user', 'user_info', 'company'));
        //dd($request);
    }

    public function client_order_save(Request $request){

        $order_code = '100000';
        $order_from_db = Order::lastOrder();
        if($order_from_db != null){
            $order_code = intval($order_from_db->order_code) + 1;
        }
        $order = $request->except('_token', 'user_id');
        $order = array_merge($order, ['order_code'=>$order_code, 'status_id'=>1, 'author'=>\Auth::user()->id]);
        //dd($order);
        $t = Order::create($order);
        if ($t){
            return redirect()->route('admin.client.index');
        }
        return redirect()->route('admin.client.order', ['client_id'=>$request->user_id])->with('message', 'Что то пошло не так');
    }

    public function client_index(){
        $users = User::where('user_type', 2)->get();
        return view('admin.client.index', compact('users'));
    }
    public function client_edit(){
            $cities = City::get();
            $id = $_GET['id'];
            $user = User::find($id);
            $user_info = UserInfo::where('user_id', $user->id)->get()->first();
            $company = Company::find($user_info->company_id);
            return view('admin.client.edit', compact('cities', 'user', 'user_info', 'company'));
        }
    public function client_create(){
        $cities = City::get();
        return view('admin.client.create', compact('cities'));
    }

    public function client_delete(Request $request){
        $client_id = $request->client_id;
        $user = User::find($client_id);
        $user->delete();
        return redirect()->back()->with(['success'=>'Успешно удален!!!']);
    }


	public function client_update(Request $request){
		$id = $request->id;
        $name       = $request->name;
        $email      = $request->email;
        $password   = $request->password;
        $role_id    = 5;
        $company_name    = $request->company;
        $city       = $request->city;
        $address    = $request->address;
        $bin        = $request->bin;
        $phone      = $request->phone;

		$user = User::find($id);
		$user_info = UserInfo::where('user_id', $user->id)->get()->first();
		$user->update([
			'name'=>$name,
			'email'=>$email,
			'password'=>Hash::make($password),
			'visible_password'=>$password,
		]);
		$user_info->update([
			'phone'=>$phone,
			'address'=>$address,
			'city_id'=>$city,
			'bin'=>$bin
		]);
       	$company = Company::find($user_info->company_id);
		$company->update([
			'company_name'=>$company_name
		]);
        //dd($request);
		return redirect()->back();
    }
    public function client_store(Request $request){
        $name       = $request->name;
        $email      = $request->email;
        $password   = $request->password;
        $role_id    = 5;
        $company    = $request->company;
        $city       = $request->city;
        $address    = $request->address;
        $bin        = $request->bin;
        $phone      = $request->phone;

        $user = User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>Hash::make($password),
            'visible_password'=>$password,
            'user_type'=>2,
        ]);
        if ($user){
            DB::table('user_roles')->insert([
                'user_id'=>$user->id,
                'role_id'=>$role_id
            ]);
            $company1 = Company::create([
                'user_id'=>$user->id,
                'company_name'=>$company == null ? '' : $company,
                'company_bin'=>$bin == null ? '' : $bin,
                'company_address'=>$address == null ? '' : $address,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ]);
            $userInfo = UserInfo::create([
                'user_id'=>$user->id,
                'phone'=>$phone == null ? '' : $phone,
                'address'=>$address == null ? '' : $address,
                'city_id'=>$city,
				'bin'=>$bin,
                'company_id'=>$company1->id,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ]);
            Session::put('message', 2);
            return redirect()->route('admin.client.index');
        }else{
            Session::put('message', 1);
            return redirect()->route('admin.client.index');
        }
        //dd($request);
    }



}
