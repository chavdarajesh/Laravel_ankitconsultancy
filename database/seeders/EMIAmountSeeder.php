<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class EMIAmountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('e_m_i_amounts')->insert([
            'emi_amount' => 10000,
            'status' => 1,
            'created_at'=>Carbon::now('Asia/Kolkata')
        ]);
    }
}
