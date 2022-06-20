<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class BankDetailsSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bank_details')->insert([
            'bank_name' => 'State Bank Of India',
            'static_id' => 1,
            'branch_name' => 'MG Road',
            'branch_code' => 456,
            'ifsc_code' => 'SBIN000456',
            'bank_aaccount_no' => 444444444444,
            'bank_aaccount_holder_name' => 'Test Name',
            'status' => 1,
            'created_at'=>Carbon::now()
    
        ]);

    }
}
