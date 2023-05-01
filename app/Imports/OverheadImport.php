<?php

namespace App\Imports;

use App\Models\City;
use App\Models\Journal;
use App\Models\Overhead;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class OverheadImport implements ToCollection
{

    public function collection(Collection $collection)
    {
        $data = [];
        $i=0;
        for ($i=1; $i<count($collection); $i++){
            $from_name = $collection[$i][1];
            $from_company = $collection[$i][1];
            $from_city = $collection[$i][2];
            $from_address = $collection[$i][3];
            $from_phone = $collection[$i][4];

            $mass = $collection[$i][6];
            $speed = $collection[$i][7];

            $to_name = $collection[$i][5];
            $to_city = $collection[$i][8];
            $to_address = $collection[$i][9];
            $to_phone = $collection[$i][10];

            $overhead_code = $collection[$i][11];
            $description = $collection[$i][12];
            $price = $collection[$i][13];
            if ($from_company != null && $from_city != null && $from_address != null && $from_phone != null){
                //print_r($i);
                //echo "<br>";

				if(City::where('city_name', trim($from_city)) == null){
					$from_city_id = 30;
				}else{
					$from_city_id = City::where('city_name', trim($from_city))->get()->first()->id;
				}
				if(City::where('city_name', trim($to_city)) == null){
					$to_city_id = 30;
				}else{
					$to_city_id = City::where('city_name', trim($to_city))->get()->first()->id;
				}


//                dd($to_city_id);
//                die();
                $overhead = Overhead::create([
                    'overhead_code' =>$overhead_code,
                    'spi'           => "CHN".$overhead_code,
                    'from_name'     =>$from_name,
                    'from_company'  =>$from_company,
                    'from_city'     =>$from_city_id,
                    'from_address'  =>$from_address,
                    'from_phone'    =>$from_phone,
                    'to_name'       =>$to_name,
                    'to_city'       =>$to_city_id,
                    'to_address'    =>$to_address,
                    'to_phone'      =>$to_phone,
                    'speed'         =>$speed,
                    'type'          => 'Посылка',
                    'payment'       => 'Отправителем',
                    'payment_type'  => 'По счету',
                    'description'   =>$description,
                    'author'        =>\Auth::user()->id,
                    'created_at'    => date("Y-m-d H:i:s"),
                    'updated_at'    => date("Y-m-d H:i:s"),
                    'place'			=> 1,
                    'price'			=> $price,
                    'mass'          => $mass,
                    'status_id'     => 1,
                    'date_s'    => date("Y-m-d H:i:s"),

                ]);
                if ($overhead){
                    $journal = Journal::create([
                        'overhead_code'=>$overhead_code,
                        'status_name'=>'У отправителя',
                        'shpi_code'=>"CHN".$overhead_code,
                        'status_id'=>1,
                        'is_active'=>1,
                        'date'=> date("Y-m-d H:i:s"),
                    ]);
                }
            }
        }
    }
}
