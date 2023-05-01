<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('statuses')->insert([
            ['status_name'=>'Новый', 'status_code'=>'new'],
            ['status_name'=>'Курьер назначен', 'status_code'=>'chosen_courier'],
            ['status_name'=>'Курьер принял', 'status_code'=>'accepted_courier'],
            ['status_name'=>'Курьер забрал', 'status_code'=>'taken_courier'],
            ['status_name'=>'На Складе', 'status_code'=>'in_store'],
            ['status_name'=>'Отправлен', 'status_code'=>'submitted'],
            ['status_name'=>'В пути', 'status_code'=>'process'],
            ['status_name'=>'Доставлен', 'status_code'=>'finish'],
        ]);
    }
}
