<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class QRCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('q_r_codes')->insert([
            'qrcodeimage' => 'assets/admin/img/custom/1655438173images.png',
            'status' => 1,
            'upiid' => 'testupi@upi',
            'created_at'=>Carbon::now('Asia/Kolkata')
        ]);
    }
}
