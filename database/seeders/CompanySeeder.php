<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('companies')->insert([
            [
                'user_id'=>1, 'company_name'=>'Magic Home Media',
                'company_bin'=>'123456789123',
                'company_address'=>'Водник 1']
        ]);
    }
}
