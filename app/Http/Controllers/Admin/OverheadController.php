<?php


namespace App\Http\Controllers\Admin;


use App\Exports\Overheads2Export;
use App\Exports\OverheadsExport;
use App\Exports\OverheadsExport3;
use App\Imports\OverheadImport;
use App\Models\City;
use App\Models\Status;
use App\Models\Order;
use App\Models\Overhead;
use App\Models\Notification;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class OverheadController extends \App\Http\Controllers\Controller
{
    /**
     * OverheadController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function setStatusFinish(Request $request){
		//dd($request);
		$overhead = Overhead::find($request->id);
		$overhead->update([
			'status_id'=>8
		]);
		$journal = Journal::create([
                'overhead_code'=>$overhead->overhead_code,
				'status_name'=>'Доставлен',
				'shpi_code'=>"CHN".$overhead->overhead_code,
                'status_id'=>8,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
		if($journal){
			return redirect()->back()->with(['finish'=>'Статус успешно обновлен', 'successFinish'=>1]);
		}else{
			return redirect()->back()->with(['finish'=>'Что то пошло не так', 'successFinish'=>0]);
		}
	}

    public function import(Request $request){
        //dd($request->file());
        if($request->file('excel_file')) {
            $file = $request->file('excel_file');
            Excel::import(new OverheadImport, $file);
            return redirect()->back()->with(['successImport'=>1, 'messageImport'=>'Данные успешно загружены']);
        }else{
            return redirect()->back()->with(['successImport'=>0, 'messageImport'=>'Ошибка!!!']);
        }
    }
    public function import2(Request $request){
        //dd($request->file());
        if($request->file('excel_file')) {
            $file = $request->file('excel_file');
            $collection = Excel::toCollection(new OverheadImport, $file);
            return json_encode(['success'=>$collection]);
        }else{
            return redirect()->back()->with(['success'=>0, 'messageImport'=>'Ошибка!!!']);
        }
    }

    public function uploadImage(Request $request){
        //dd($request);

        if($request->file('image')){
            $file= $request->file('image');
            $filename= $file->getClientOriginalName();
            $file-> move(public_path('assets/overhead_photo'), $filename);
            $data['image']= $filename;

            $overhead = Overhead::find($request->overhead_id);
            //dd($overhead);
            $overhead->update([
                'image_file'=>$filename,
            ]);
            $overhead->save();
        }

        return redirect()->back();
    }

	public function export3(Request $request){
		if(!is_null($request->input('from_date'))){
			$from_date = $request->input('from_date');
			$to_date = $request->input('to_date');
		}else{
			$from_date = $request->input('from_date2');
			$to_date = $request->input('to_date2');
		}
		if (strlen($from_date) < 11){

			$from_date = $from_date.' 00:00:00';
		}
		if (strlen($to_date) < 11){
			$to_date = $to_date.' 23:59:59';
		}

		if (!is_null($request->input('from_company'))){
			$from_company = $request->input('from_company');
			$overheads = Overhead::select(
				'created_at','overhead_code', 'from_name', 'from_company', 'from_city', 'from_address', 'from_phone',
				'to_name', 'to_company', 'to_city', 'to_address', 'to_phone',
				'type', 'speed', 'payment', 'payment_type', 'description','mass'
			)
				->where('from_company', "like", "%".$from_company."%")
				->whereBetween('created_at', [$from_date, $to_date])
				->orderBy('created_at', 'DESC')
				->get();
			$overheads = $this->modifier($overheads);
			//dd($overheads);
			return Excel::download(new OverheadsExport3($overheads), 'overheads.xlsx');
		}else{
			$overheads = Overhead::select(
				'created_at','overhead_code', 'from_name', 'from_company', 'from_city', 'from_address', 'from_phone',
				'to_name', 'to_company', 'to_city', 'to_address', 'to_phone',
				'type', 'speed', 'payment', 'payment_type', 'description','mass'
			)
				->whereBetween('created_at', [$from_date, $to_date])
				->orderBy('created_at', 'DESC')
				->get();
			$overheads = $this->modifier($overheads);
			//dd($overheads);
			return Excel::download(new OverheadsExport3($overheads), 'overheads.xlsx');
		}

	}

	public function export4(Request $request){

		//print_r($data);
		if(!is_null($request->input('from_date'))){
			$from_date = $request->input('from_date');
			$to_date = $request->input('to_date');
		}else{
			$from_date = $request->input('from_date2');
			$to_date = $request->input('to_date2');
		}
		if (strlen($from_date) < 11){

			$from_date = $from_date.' 00:00:00';
		}
		if (strlen($to_date) < 11){
			$to_date = $to_date.' 23:59:59';
		}

		if (!is_null($request->input('from_name'))){
			$from_company = $request->input('from_name');
			$overheads = Overhead::select(
				'created_at','overhead_code', 'from_name', 'from_company', 'from_city', 'from_address', 'from_phone',
				'to_name', 'to_company', 'to_city', 'to_address', 'to_phone',
				'type', 'speed', 'payment', 'payment_type', 'description','mass'
			)
				->where('from_name', "like", "%".$from_company."%")
				->whereBetween('created_at', [$from_date, $to_date])
				->orderBy('created_at', 'DESC')
				->get();
			$overheads = $this->modifier($overheads);
			//dd($overheads);
			return Excel::download(new OverheadsExport3($overheads), 'overheads.xlsx');
		}else{
			$overheads = Overhead::select(
				'created_at','overhead_code', 'from_name', 'from_company', 'from_city', 'from_address', 'from_phone',
				'to_name', 'to_company', 'to_city', 'to_address', 'to_phone',
				'type', 'speed', 'payment', 'payment_type', 'description','mass'
			)
				->whereBetween('created_at', [$from_date, $to_date])
				->orderBy('created_at', 'DESC')
				->get();
			$overheads = $this->modifier($overheads);
			//dd($overheads);
			return Excel::download(new OverheadsExport3($overheads), 'overheads.xlsx');
		}

	}
	public function modifier($overheads){
		foreach ($overheads as $overhead){
			if(!is_null(City::find($overhead->from_city))){
				$overhead->from_city = City::find($overhead->from_city)->city_name;
			}else{
				$overhead->from_city = 'Не указан';
			}
			if(!is_null(City::find($overhead->to_city))){
				$overhead->to_city = City::find($overhead->to_city)->city_name;
			}else{
				$overhead->to_city = 'Не указан';
			}
			if(is_null($overhead->to_company) || strlen($overhead->to_company) < 1){
				$overhead->to_company = '';
			}
			if(is_null($overhead->from_company) || strlen($overhead->from_company) < 1){
				$overhead->from_company = '';
			}

		}
		return $overheads;
	}
	public function checker(){
		if (strlen($this->from_company) == 0){

			foreach ($overheads as $overhead){
				if(!is_null(City::find($overhead->from_city))){
					$overhead->from_city = City::find($overhead->from_city)->city_name;
				}else{
					$overhead->from_city = 'Не указан';
					}


				if(!is_null(City::find($overhead->to_city))){
					$overhead->to_city = City::find($overhead->to_city)->city_name;
				}else{
					$overhead->to_city = 'Не указан';
					}
				if(is_null($overhead->to_company) || strlen($overhead->to_company) < 1){
					$overhead->to_company = '';
				}
				if(is_null($overhead->from_company) || strlen($overhead->from_company) < 1){
					$overhead->from_company = '';
				}

			}
			//return $overheads;
		}else{
			$overheads = Overhead::select(
				'overhead_code', 'from_name', 'from_company', 'from_city', 'from_address', 'from_phone',
				'to_name', 'to_company', 'to_city', 'to_address', 'to_phone',
				'type', 'speed', 'payment', 'payment_type', 'description'
			)
				->where('from_company', "like", "%".$this->from_company."%")
				->whereBetween('created_at', [$this->from_date, $this->to_date])
				->orderBy('created_at', 'DESC')
				->get();
			//return $overheads;
			foreach ($overheads as $overhead){
				if(!is_null(City::find($overhead->from_city))){
					$overhead->from_city = City::find($overhead->from_city)->city_name;
				}else{
					$overhead->from_city = 'Не указан';
				}

				if(!is_null(City::find($overhead->to_city))){
					$overhead->to_city = City::find($overhead->to_city)->city_name;
				}else{
					$overhead->to_city = 'Не указан';
				}
				if(is_null($overhead->to_company) || strlen($overhead->to_company) < 1){
					$overhead->to_company = '';
				}
				if(is_null($overhead->from_company) || strlen($overhead->from_company) < 1){
					$overhead->from_company = '';
				}
			}
		}
	}


    public function export1(Request $request){
        //dd($request);
		//return 0;
        if (isset($_GET) && !empty($_GET)){
            if(isset($_GET['from_date'])){
				$from_date = $_GET['from_date'];
				$to_date = $_GET['to_date'];
			}else{
				$from_date = $_GET['from_date2'];
				$to_date = $_GET['to_date2'];
			}
            if (strlen($from_date) < 10){
                $from_date = $from_date.' 00:00:00';
            }
            if (strlen($to_date) < 10){
                $to_date = $to_date.' 23:59:00';
            }

            if (isset($_GET['from_company']) && !empty($_GET['from_company'])){
                $from_company = $_GET['from_company'];
				//dd($from_date);
				//dd(new OverheadsExport($from_company, $from_date, $to_date));
                return Excel::download(new OverheadsExport($from_company, $from_date, $to_date), 'overheads.xlsx');
            }
			//dd($from_date);
			//dd(new OverheadsExport($from_company, $from_date, $to_date));
            return Excel::download(new OverheadsExport('', $from_date, $to_date), 'overheads.xlsx');
        }


    }
    public function export2(Request $request){
		//return 0;
        if (isset($_GET) && !empty($_GET)){
            if(isset($_GET['from_date'])){
				$from_date = $_GET['from_date'];
				$to_date = $_GET['to_date'];
			}else{
				$from_date = $_GET['from_date2'];
				$to_date = $_GET['to_date2'];
			}
            if (strlen($from_date) < 10){
                $from_date = $from_date.' 00:00:00';
            }
            if (strlen($to_date) < 10){
                $to_date = $to_date.' 23:59:00';
            }

            if (isset($_GET['from_name']) && !empty($_GET['from_name'])){
                $from_company = $_GET['from_name'];
                //return Excel::download(new Overheads2Export($from_company, $from_date, $to_date), 'overheads.xlsx');
            }
            //return Excel::download(new Overheads2Export('', $from_date, $to_date), 'overheads.xlsx');
        }
    }


	public function delete(){
		if(isset($_GET)){
			$id = $_GET['id'];
			$overhead = Overhead::find($id)->delete();
			return redirect()->back();
		}
	}

	public function index2(){
		$from = date("Y-m-d 00:00:00");
		$to = date("Y-m-d 23:59:59");
		$statuses = Status::get();
		$overheads = Overhead::whereBetween('created_at', [$from, $to])->orderBy('id', 'DESC')->get();
		if(isset($_GET) && !empty($_GET)){
			if(isset($_GET['from_date'])){
				$from_date = $_GET['from_date'].' 00:00:00';
				$to_date = $_GET['to_date'].' 23:59:00';
			}else{
				$from_date = $_GET['from_date2'].' 00:00:00';
				$to_date = $_GET['to_date2'].' 23:59:00';
			}
			if((isset($_GET['from_company']) && !empty($_GET['from_company']))){
				$from_company = $_GET['from_company'];
				$overheads = Overhead::where('from_company', "like", "%".$from_company."%")
					->whereBetween('created_at', [$from_date, $to_date])
					->orderBy('id', 'DESC')->get();
			}
			else if((isset($_GET['from_name']) && !empty($_GET['from_name']))){
				$from_name = $_GET['from_name'];
				$overheads = Overhead::where('from_name', "like", "%".$from_name."%")
					->whereBetween('created_at', [$from_date, $to_date])
					->orderBy('id', 'DESC')->get();
			}
			else{
				$overheads = Overhead::whereBetween('created_at', [$from_date, $to_date])->orderBy('id', 'DESC')->get();
			}

			return view('admin.overhead.index2', compact('overheads', 'statuses'));
		}else{
			return view('admin.overhead.index2', compact('overheads', 'statuses'));
		}
	}
	public function archive2(){
		$from = date("Y-m-d 00:00:00", strtotime("-1 months"));
		$to = date("Y-m-d 23:59:59");
		$statuses = Status::get();
		$overheads = Overhead::whereBetween('created_at', [$from, $to])->limit(300)->orderBy('id', 'DESC')->get();
		if(isset($_GET) && !empty($_GET)){
			if(isset($_GET['from_date'])){
				$from_date = $_GET['from_date'].' 00:00:00';
				$to_date = $_GET['to_date'].' 23:59:00';
			}else{
				$from_date = $_GET['from_date2'].' 00:00:00';
				$to_date = $_GET['to_date2'].' 23:59:00';
			}
			if((isset($_GET['from_company']) && !empty($_GET['from_company']))){
				$from_company = $_GET['from_company'];
				$overheads = Overhead::where('from_company', "like", "%".$from_company."%")
					->whereBetween('created_at', [$from_date, $to_date])->limit(300)
					->orderBy('id', 'DESC')->get();
			}
			else if((isset($_GET['from_name']) && !empty($_GET['from_name']))){
				$from_name = $_GET['from_name'];
				$overheads = Overhead::where('from_name', "like", "%".$from_name."%")
					->whereBetween('created_at', [$from_date, $to_date])->limit(300)
					->orderBy('id', 'DESC')->get();
			}
			else{
				$overheads = Overhead::whereBetween('created_at', [$from_date, $to_date])->orderBy('id', 'DESC')->get();
			}

			return view('admin.overhead.index2', compact('overheads', 'statuses'));
		}else{
			return view('admin.overhead.index2', compact('overheads', 'statuses'));
		}
	}

    public function index(){

		if(isset($_GET['searchRow'])){
			if(isset($_GET['company_search']) && !empty($_GET['company_search'])){
				$company_search = $_GET['company_search'];
			}else{
				$company_search = "";
			}
			if(isset($_GET['date_s']) && !empty($_GET['date_s'])){
				$date_s = $_GET['date_s'];
			}else{
				$date_s = "";
			}
			if(isset($_GET['payment_search']) && !empty($_GET['payment_search'])){
				$payment_search = $_GET['payment_search'];
			}else{
				$payment_search = "";
			}
			if(isset($_GET['payment_search_type']) && !empty($_GET['payment_search_type'])){
				$payment_search_type = $_GET['payment_search_type'];
			}else{
				$payment_search_type = "";
			}
			//dd($company_search);
			$statuses = Status::get();
			$offset = 500;
			if(isset($_GET['next']) && !empty($_GET['next'])){
				$skip = $_GET['next'];
			}else{
				$skip = 0;
			}
			$count5 = count(Overhead::get());
			//dd($count5);
			//dd(empty($company_search));
			if(!empty($company_search) && !empty($date_s)){
				//dd(55);
				$statuses = Status::get();
				$offset = 500;
				if(isset($_GET['next']) && !empty($_GET['next'])){
					$skip = $_GET['next'];
				}else{
					$skip = 0;
				}
				$count5 = count(Overhead::get());
				//dd($count5);
				//$overheads = Overhead::orderBy('id', 'DESC')->take($offset)->get();
				$overheads = Overhead::where('from_company','LIKE', '%'.trim($company_search).'%')
					->where('created_at','>=', $date_s)
					->orderBy('id', 'DESC')->get();
				return view('admin.overhead.index', compact('overheads','count5', 'statuses'));
			}else if(!empty($company_search) && empty($date_s)){
				//dd(44);
				$statuses = Status::get();
				$offset = 500;
				//dd($company_search);
				$count5 = count(Overhead::get());
				//dd($count5);
				//dd(Overhead::where('from_company','LIKE', '%'.trim($company_search).'%')->get());
				$overheads = Overhead::where('created_at','>=', date("Y-m-d 00:00:00"))->where('from_company','LIKE', '%'.trim($company_search).'%')
					->orderBy('id', 'DESC')->get();
				return view('admin.overhead.index', compact('overheads','count5', 'statuses'));
			}else if(empty($company_search) && !empty($date_s)){
				$statuses = Status::get();
				$offset = 500;
				if(isset($_GET['next']) && !empty($_GET['next'])){
					$skip = $_GET['next'];
				}else{
					$skip = 0;
				}
				$count5 = count(Overhead::get());
				//dd($count5);
				$overheads = Overhead::where('created_at','>=', $date_s)->orderBy('id', 'DESC')->get();
				return view('admin.overhead.index', compact('overheads','count5', 'statuses'));
			}else{
				$statuses = Status::get();

				if(isset($_GET['next']) && !empty($_GET['next'])){
					$skip = $_GET['next'];
				}else{
					$skip = 0;
				}
				$count5 = count(Overhead::get());
				//dd($count5);
				$overheads = Overhead::where('created_at','>=', date("Y-m-d 00:00:00"))->orderBy('id', 'DESC')->get();
				return view('admin.overhead.index', compact('overheads', 'count5', 'statuses'));
			}

		}else{
			$statuses = Status::get();

			if(isset($_GET['next']) && !empty($_GET['next'])){
				$skip = $_GET['next'];
			}else{
				$skip = 0;
			}
			$count5 = count(Overhead::get());
			//dd($count5);
			$overheads = Overhead::where('created_at','>=', date("Y-m-d 00:00:00"))->orderBy('id', 'DESC')->get();
			//$archives = Overhead::orderBy('id', 'DESC')->take($offset)->get();
			return view('admin.overhead.index', compact('overheads', 'count5', 'statuses'));
		}



    }

	public function archive(){
		$statuses = Status::get();
		//$offset = 100;
		if(isset($_GET['next']) && !empty($_GET['next'])){
			$skip = $_GET['next'];
		}else{
			$skip = 0;
		}
		$count5 = count(Overhead::get());
		//dd($count5);
        $overheads = Overhead::orderBy('id', 'DESC')->get();
        $archives = Overhead::orderBy('id', 'DESC')->take(2000)->get();
        return view('admin.overhead.archive', compact('overheads', 'count5', 'statuses', 'archives'));
	}
    public function create(){
        $user = Auth::user();
        $role = $user->roles()->get()->first();
        //dd($role->get()->first());
        $cities = City::get();
        $userInfo = $user->info()->get()->first();
        $company = $user->company()->get()->first();
        $city=City::find($userInfo->city_id);
        $cityDef = City::find($userInfo->city_id);

        if ($role->id === 5){
            return view('admin.overhead.create', compact('cityDef','cities','user', 'userInfo', 'role'));
        }

        return view('admin.overhead.create2', compact('cities','user', 'userInfo', 'role'));
    }

    public function store(Request $request){
		$sub_zone = "";
		if($request->sub_zone != null){
			//dd($request->sub_zone);
			$sub_zone = $request->sub_zone;
		}
		//dd("no");
        $user_id    = $request->user_id;
        $overhead_code = $request->overhead_code;

		$price  = $request->price;

        $from_name      = $request->from_name;
        $from_company   = $request->from_company;

        $from_city      = $request->from_city;
        if ($from_city == 0){
            $from_city_name = 'Алматы';
        }else{
            $from_city_name = City::find($from_city)->city_name;
        }
        //$from_city_name = City::find($from_city)->city_name;

        $from_phone     = $request->from_phone;
        $from_address   = $request->from_address;

        $to_name      = $request->to_name;
        $to_company   = $request->to_company;

        $to_city      = $request->to_city;
        $to_city_name = '';
		$to_city_name = $to_city;
        /*
		if ($to_city == 0){
            $to_city_name = 'Алматы';
        }else{
            $to_city_name = City::find($to_city)->city_name;
        }
		*/

        $to_phone     = $request->to_phone;
        $to_address   = $request->to_address;

        $type           = $request->type;
        $speed          = $request->speed;
        $payment        = $request->payment;
        $payment_type   = $request->payment_type;

        $mass           = str_replace(',','.',$request->mass);
        $volume         = str_replace(',','.',$request->volume);
        $length         = str_replace(',','.',$request->length);
        $height         = str_replace(',','.',$request->height);
        $width          = str_replace(',','.',$request->width);

        $date_s = $request->date_s;
        $date_e = $request->date_e;
        //dd($request);
		//if(){}
        $description    = $request->description;
        /*if ($from_name == null || $from_address == null || $from_phone == null){
            Session::put('message', 3);
            return redirect()->route('admin.overheads.create');
        }*/

        //dd($overhead_code);
//        $overhead_code = '100000';
        $over = substr($from_company, 0, 2);
		//dd($overhead_code);


		$user = Auth::user();
		$role = $user->roles()->get()->first();
		//dd($role->get()->first());
		$cities = City::get();
		$userInfo = $user->info()->get()->first();
		$company = $user->company()->get()->first();
		$city=City::find($userInfo->city_id);
		$cityDef = City::find($userInfo->city_id);
		//dd($overhead_code);
		//dd($overhead_code==0);
        if (($overhead_code === 0) || ($overhead_code == null) || (strlen($overhead_code) < 2)) {
			//dd(55);
            $overhead_from_db = Overhead::lastOverhead();
            if ($overhead_from_db != null) {
				if(strlen($overhead_from_db->overhead_code) > 6){
					//echo $overhead_from_db;
					$overhead_code = intval(substr($overhead_from_db->overhead_code, 0, -2))+1;
					//echo $overhead_code;
				}else{
					$overhead_code = intval($overhead_from_db->overhead_code) + 1;
				}
                //$overhead_code = intval(substr($overhead_from_db,2));
                //$overhead_code = intval($overhead_from_db->overhead_code) + 1;
                //$overhead_code = $over.($overhead_code + 1);
                //$overhead_code = $over.($overhead_code + 1);
            } else {
                $overhead_code = 500000010000;
                //$overhead_code = substr($from_company, 0, 2);
                //$overhead_code = substr($from_company, 3);
                //$overhead_code = strtoupper($overhead_code);

            }
        }
		//dd($overhead_code);
		/*else{
			Session::put('message', 3);
            return redirect()->route('admin.overheads.create',compact('cities','user', 'userInfo', 'role'));
		}*/
		//die();
        //dd($overhead_code);
        $overhead = DB::table('overheads')->insert([
            [
                'overhead_code' =>$overhead_code,
				'spi'           => "CHN".$overhead_code,
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
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
				'place'			=> $request->place,
				'price'			=> $price,
                'mass'          => $mass,
                'volume'        => $volume,
                'length'        => $length,
                'width'         => $width,
                'height'        => $height,
                'status_id'     => 1,
                'date_s'    => $date_s,
                'date_e'	=> $date_e,
				'sub_zone'=>$sub_zone
            ]
        ]);


        if ($overhead){
            $role_id = DB::table('user_roles')->where('user_id', $user_id)->get()->first();


            $journal = Journal::create([
                'overhead_code'=>$overhead_code,
				'status_name'=>'У отправителя',
				'shpi_code'=>"CHN".$overhead_code,
                'status_id'=>1,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
            //dd($role_id);
            if ($role_id->role_id == 5){
                return redirect()->route('admin.cabinet.overhead');
            }

            Session::put('message', 0);
            return redirect()->route('admin.overheads.create',compact('cities','user', 'userInfo', 'role'));
        }else{
            Session::put('message', 1);
            return redirect()->route('admin.overheads.create',compact('cities','user', 'userInfo', 'role'));
        }
    }
    public function show(){
        $user  = Auth::user();
        $user_id = $user->id;
        $role = $user->roles()->get()->first();
        $overhead_id = $_GET['overhead_id'];
        $overhead = Overhead::find($overhead_id);
		/*$notification = Notification::where('item_id', $overhead_id)->where('type', 'overhead')
			->update([
				'readed'=>0
			]);*/
        $cities = City::get();
        return view('admin.overhead.show', compact('overhead', 'cities', 'role'));
    }

    public function searchOverhead(Request $request){
        $search_overhead = $request->search_overhead;
		//return 0;
        $overhead = Overhead::where('overhead_code', $search_overhead)->get()->first();
		$overheads = Overhead::where('overhead_code', $search_overhead)->get();
		if(is_null($overhead)){
			return redirect()->back();
			//return 0;
		}
		//dd($overhead);
        $journals = Journal::where('overhead_code', $search_overhead)->get();
        //dd($overhead);
        $from_city = $overhead->from_city;
		if(strlen($overhead->from_city) == 1 && strlen($overhead->from_city) == 2){
			$from_city = City::find($overhead->from_city)->city_name;
		}

        $to_city = $overhead->to_city;
		if(strlen($overhead->to_city) > 1 && strlen($overhead->to_city) == 2){
			$to_city = City::find($overhead->to_city)->city_name;
		}
        $count = count($journals);
        //dd(count($journals));
        //dd($journals);
        return view('admin.overhead.singleShow', compact('overhead', 'overheads', 'journals', 'from_city', 'to_city'));
    }

	public function searchOverhead2(Request $request){
        $search_overhead = $request->search_overhead2;
		//return 0;
        $overhead = Overhead::where('overhead_code', $search_overhead)->get()->first();
		$overheads = Overhead::where('overhead_code', $search_overhead)->get();
		if(is_null($overhead)){
			return redirect()->back();
			//return 0;
		}
		//dd($overhead);
        $journals = Journal::where('overhead_code', $search_overhead)->get();
        //dd($overhead);
        $from_city = $overhead->from_city;
		if(strlen($overhead->from_city) == 1 && strlen($overhead->from_city) == 2){
			$from_city = City::find($overhead->from_city)->city_name;
		}

        $to_city = $overhead->to_city;
		if(strlen($overhead->to_city) > 1 && strlen($overhead->to_city) == 2){
			$to_city = City::find($overhead->to_city)->city_name;
		}
        $count = count($journals);
        //dd(count($journals));
        //dd($journals);
        return view('admin.overhead.singleShow2', compact('overhead', 'overheads', 'journals', 'from_city', 'to_city'));
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
		return view('admin.overhead.edit1', compact('overhead', 'user', 'cities'));
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
			return redirect()->route('admin.overheads.edit1', compact('overhead_id', 'user', 'cities'));
		}else{
			return redirect()->route('admin.overheads.index');
		}
	}

	public function edit2(){
		$overhead_id = $_GET['overhead_id'];
		$overhead = Overhead::find($overhead_id);
		$user = Auth::user();
		$statuses = Status::get();
        $role = $user->roles()->get()->first();
        //dd($role->get()->first());
        $cities = City::get();
        $userInfo = $user->info()->get()->first();
        $company = $user->company()->get()->first();
        $city=City::find($userInfo->city_id);
        $cityDef = City::find($userInfo->city_id);
		//echo "Hello";
		return view('admin.overhead.edit2', compact('overhead', 'user', 'cities', 'statuses'));
	}
	public function update2(Request $request){

		$sub_zone = "";
		if($request->sub_zone != null){
			$sub_zone = $request->sub_zone;
		}

		$user_id = $request->user_id;
		$status_id = $request->status_id;
		$overhead_id = $request->overhead_id;
		$overhead_code = $request->overhead_code;
		$from_name = $request->from_name;
		$from_company = $request->from_company;
		$from_city = $request->from_city;
		$from_phone = $request->from_phone;
		$from_address = $request->from_address;
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
		$width = $request->width;
		$height = $request->height;
		$volume = $request->volume;
		$length = $request->length;

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
				"mass"=>$mass,
				"length"=>$length,
				"volume"=>$volume,
				"width"=>$width,
				"height"=>$height,
			  "payment_type" => $payment_type,
			  "date_s" => $date_s,
			  "date_e" => $date_e,
			  "description" => $description,
			  "status_id"=>$status_id,
				"sub_zone" => $sub_zone
			]);
		if($overhead2){
			$city = City::find($to_city)->city_name;
			$status_name = Status::find($status_id)->status_name;
			if($status_id == 7){
				$status_name = Status::find($status_id)->status_name." ".$city;
			}
			$journal = Journal::create([
                'overhead_code'=>$overhead_code,
				'shpi_code'=>"CHN".$overhead_code,
				'status_name'=>$status_name,
                'status_id'=>$status_id,
                'is_active'=>1,
                'date'=> date("Y-m-d H:i:s"),
            ]);
			$overhead = Overhead::find($overhead_id);
			//return redirect()->route('admin.overheads.edit2', compact('overhead_id', 'user', 'cities'));
			return redirect()->back()->with(['success'=>'Успешно обновлен']);
		}else{
			return redirect()->route('admin.overheads.index');
		}
	}

	public function edit3(){
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
		return view('admin.overhead.edit3', compact('overhead', 'user', 'cities'));
	}
	public function update3(Request $request){
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
			  "description" => $description
			]);
		if($overhead2){
			$overhead = Overhead::find($overhead_id);
			return redirect()->route('admin.overheads.edit3', compact('overhead_id', 'user', 'cities'));
		}else{
			return redirect()->route('admin.overheads.index');
		}
	}
	public function editStatus(){
		//dd($_GET);
		if(isset($_GET)){
			$id = $_GET['overhead_id'];
			$status = $_GET['status'];
			$date_status = empty($_GET['date_status'])?null:$_GET['date_status'];
			$description = empty($_GET['description'])?"------":$_GET['description'];
			//dd($date_status);
			$overhead = Overhead::find($id);
			$city_id = $_GET['city'];
			if($city_id != 0){
				$city = City::find($city_id)->city_name;
			}else{
				$city = "";
			}

			//$city = City::find($city_id)->city_name;
			$status_name = Status::find($status)->status_name;
			if($status == 7){
				$status_name = Status::find($status)->status_name." ".$city;
			}

			$overhead->update([
				'status_id'=>$status,
				'date_e'=>$date_status,
				'description'=>$description
			]);
			$journal = Journal::create([
				'overhead_id'=>$id,
				'status_name' => Status::find($status)->status_name,
				'overhead_code'=>$overhead->overhead_code,
				'shpi_code'=>"CHN".$overhead->overhead_code,
				'date'=>$date_status,
				'status_id'=>$status
			]);
			if($journal){
				return redirect()->back()->with(['success'=>'Статус успешно обновлен']);
			}
			//dd($overhead);
		}

		return json_encode(['success'=>5]);
	}
}
