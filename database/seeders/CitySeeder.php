<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            ['city_name'=>'Нур-Султан', 'city_code'=>'NUR', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Караганда', 'city_code'=>'KAR', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Петропавловск', 'city_code'=>'PET', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Павлодар', 'city_code'=>'PAV', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Костанай', 'city_code'=>'KOS', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Кокшетау', 'city_code'=>'KOK', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Усть-Каменегорск', 'city_code'=>'UST', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Семей', 'city_code'=>'SEM', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Кызылорда', 'city_code'=>'KYZ', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Шымкент', 'city_code'=>'SHY', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Тараз', 'city_code'=>'TAR', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Атырау', 'city_code'=>'ATY', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Актау', 'city_code'=>'AKT', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Актобе', 'city_code'=>'AKO', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Уральск', 'city_code'=>'URA', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Талдыкорган', 'city_code'=>'TAL', 'city_zone'=>1, 'longitude'=>0, 'latitude'=>0],

            ['city_name'=>'Аксай', 'city_code'=>'AKS', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Балхаш', 'city_code'=>'BAL', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Жанаозен', 'city_code'=>'ZHA', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Екибастуз', 'city_code'=>'EKI', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Аксу', 'city_code'=>'AKU', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Риддер', 'city_code'=>'RID', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Рудный', 'city_code'=>'RUD', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Жезказган', 'city_code'=>'ZHE', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Сатбаев', 'city_code'=>'SAT', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Темиртау', 'city_code'=>'TEM', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Туркестан', 'city_code'=>'TUR', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Талгар', 'city_code'=>'TAG', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Каскелен', 'city_code'=>'KAS', 'city_zone'=>2, 'longitude'=>0, 'latitude'=>0],

            ['city_name'=>'Другое', 'city_code'=>'DRU', 'city_zone'=>3, 'longitude'=>0, 'latitude'=>0],
            ['city_name'=>'Алматы', 'city_code'=>'ALM', 'city_zone'=>0, 'longitude'=>0, 'latitude'=>0],
        ]);
    }
}
