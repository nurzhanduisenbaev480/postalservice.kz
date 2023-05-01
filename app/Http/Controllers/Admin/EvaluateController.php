<?php


namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Order;
use App\Models\Overhead;
use App\Models\Contract;
use App\Models\Tarif;
use App\Models\Evaluate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers;

class EvaluateController extends \App\Http\Controllers\Controller{
    /**
     * EvaluateController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $overheads = Overhead::where('status_id', 14)->orWhere('status_id', 15)->orWhere('status_id', 16)->get();
        //dd($overheads);
        return view('admin.evaluate.index', compact('overheads'));
    }

    public function show(){
        $user  = Auth::user();
        $user_id = $user->id;
        $role = $user->roles()->get()->first();
        $overhead_id = $_GET['id'];
        $overhead = Overhead::find($overhead_id);
        $cities = City::get();
        return view('admin.evaluate.show', compact('overhead', 'cities', 'role'));
    }

    public function showEval(){
        //dd($_GET);
        $id = $_GET['id'];
        $overhead = Overhead::find($id);
        $contracts = Contract::get();
        $contract = Contract::where('overhead_id', $overhead->id)->get()->first();
        $evaluate = Evaluate::where('overhead_id', $overhead->id)->orderBy('id', 'DESC')->get()->first();
        //dd($contract);
        return view('admin.evaluate.showEval', compact('overhead', 'contracts', 'contract', 'evaluate'));
    }

    public function setPlan(Request $request){
        $overhead_id  = $request->overhead_id;
        $contract = $request->contract;
        $overhead = Overhead::find($overhead_id);
        $contracts = Contract::get();
        $contract1 = Contract::where('overhead_id', $overhead_id)->get()->first();
        $evaluate = Evaluate::where('overhead_id', $overhead_id)->get()->first();
       //dd($contract);
        if($contract == 0){
            $con = Contract::where('overhead_id', $overhead_id)->update([
                'overhead_id'=>0,
            ]);
            return redirect()->route('admin.evaluate.showEval', ['id'=>$overhead_id])->with(compact('overhead', 'contracts', 'contract1', 'evaluate'));
        }
        $contractV = Contract::find($contract)->update([
            'overhead_id'=>$overhead_id,
        ]);
        if($contractV){
            return redirect()->route('admin.evaluate.showEval', ['id'=>$overhead_id])->with(compact('overhead', 'contracts', 'contract1', 'evaluate'));
        }
        //dd($contract);
    }


    public function eval(Request $request){
        $overhead_id = $request->overhead_id_eval;
        $overhead = Overhead::find($overhead_id);
        $contracts = Contract::get();
        $contract1 = Contract::where('overhead_id', $overhead_id)->get()->first();
        $to_city = $overhead->to_city;
        $city = City::where('city_name', $to_city)->get()->first();
        $over_mass = $overhead->mass;
        $speed = $overhead->speed;
        //dd($overhead->mass);
        if($contract1 == null){
            $length = $overhead->length;
            $width = $overhead->width;
            $height = $overhead->height;
            $zone = $city->city_zone;
            $sum = 0;
            if($speed == 'Экспресс'){
                $sum = $this->expressEval($length, $width, $height, $zone, $over_mass);

            }else{
                $sum = $this->standartEval($length, $width, $height, $zone, $over_mass);
            }
           // dd($sum);
            $eval = Evaluate::create([
                'overhead_id' => $overhead_id,
                'sum' => $sum,
                'mass' => $over_mass,
                'price' => 0,
                'oil_price' => 0.1,
                'date' => date("Y-m-d H:i:s"),
                'length' => 0,
                'width' => 0,
                'height' => 0,
            ]);
            if($eval){
                $evaluate = Evaluate::where('overhead_id', $overhead_id)->get()->first();
                return redirect()->route('admin.evaluate.showEval', ['id'=>$overhead_id])->with(compact('overhead', 'contracts', 'contract1', 'evaluate'));
            }

        }else{
            //dd('gg');
            //dd($city->city_zone);
            $zone = $city->city_zone;
            $mass = $contract1->mass;
            $speed = $contract1->speed;
            $sum = 0;
            //dd($speed);
            // исходящий
            // 250  350 425     Экспресс
            // 150  175	225     Стандарт

            // входящий
            // 400	500	600 Экспресс
            // 250	400	500 Стандарт

            if($speed="Экспресс"){
                if($zone == 1){
                    $price = $contract1->price;
                    if($over_mass > $mass){
                        $sum += ($over_mass-$mass)*250+$price;
                        //dd($sum);
                    }
                    $sum += $price;

                }
                if($zone == 2){
                    $price = $contract1->price;
                    if($over_mass > $mass){
                        $sum += ($over_mass-$mass)*350+$price;
                        //dd($sum);
                    }
                    $sum += $price;

                }
                if($zone == 3){
                    $price = $contract1->price;
                    if($over_mass > $mass){
                        $sum += ($over_mass-$mass)*425+$price;
                        //dd($sum);
                    }
                    $sum += $price;

                }
            }
            if($speed="Стандарт"){
                if($zone == 1){
                    $price = $contract1->price;
                    if($over_mass > $mass){
                        $sum += ($over_mass-$mass)*150+$price;
                        //dd($sum);
                    }
                    $sum += $price;

                }
                if($zone == 2){
                    $price = $contract1->price;
                    if($over_mass > $mass){
                        $sum += ($over_mass-$mass)*175+$price;
                        //dd($sum);
                    }
                    $sum += $price;

                }
                if($zone == 3){
                    $price = $contract1->price;
                    if($over_mass > $mass){
                        $sum += ($over_mass-$mass)*225+$price;
                        //dd($sum);
                    }
                    $sum += $price;
                }
            }
            $sum += ($sum*10)/100;
            //dd($sum);
            $eval = Evaluate::create([
                'overhead_id' => $overhead_id,
                'sum' => $sum,
                'mass' => $mass,
                'price' => $price,
                'oil_price' => 0.08,
                'date' => date("Y-m-d H:i:s"),
                'length' => 0,
                'width' => 0,
                'height' => 0,
            ]);
            if($eval){
                $evaluate = Evaluate::where('overhead_id', $overhead_id)->get()->first();
                return redirect()->route('admin.evaluate.showEval', ['id'=>$overhead_id])->with(compact('overhead', 'contracts', 'contract1', 'evaluate'));
            }

        }

    }
    private function expressEval($length, $width, $height, $zone, $mass){
        $volume = $length * $width * $height;
        $volume = $volume/5000;
        $finalSum = 0;
        if($zone == 1){
            if($mass < 2){
                // 1800 2200 2800
                $finalSum  = $finalSum + 1800;
            }else if($mass > 2){
                $finalSum  = $finalSum + (($mass-2)*250) + 1800;
            }
            echo $finalSum;
        }
        if($zone == 2){
            if($mass < 2){
                // 1800 2200 2800
                $finalSum  = $finalSum + 2200;
            }else if($mass > 2){
                $finalSum  = $finalSum + (($mass-2)*350) + 2200;
            }
        }
        if($zone == 3){
            if($mass < 2){
                // 1800 2200 2800
                $finalSum  = $finalSum + 2800;
            }else if($mass > 2){
                $finalSum  = $finalSum + (($mass-2)*425) + 2800;
            }
        }
        $finalSum = $finalSum + ($finalSum/10)/100;
        return $finalSum;
    }
    private function standartEval($length, $width, $height, $zone, $mass){
         // 150  175	225     Стандарт
        $volume = $length * $width * $height;
        $volume = $volume/5000;
        $finalSum = 0;
        if($zone == 1){
            if($mass < 2){
                // 1400 1900 2500
                $finalSum  = $finalSum + 1400;
            }else if($mass > 2){
                $finalSum  = $finalSum + (($mass-2)*150) + 1400;
            }
            // echo $mass;
            // echo "<br>";
            // echo $finalSum;
        }
        if($zone == 2){
            if($mass < 2){

                $finalSum  = $finalSum + 1900;
            }else if($mass > 2){
                $finalSum  = $finalSum + (($mass-2)*175) + 1900;
            }
        }
        if($zone == 3){
            if($mass < 2){

                $finalSum  = $finalSum + 2500;
            }else if($mass > 2){
                $finalSum  = $finalSum + (($mass-2)*225) + 2500;
            }
        }
        $finalSum = $finalSum + ($finalSum/10)/100;
        return $finalSum;
    }

}



