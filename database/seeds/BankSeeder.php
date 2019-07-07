<?php

use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=[
            ['name'=>'VietinBank','image'=>14,'account_name'=>'CÔNG TY TNHH TM & DV KỸ NGHỆ VIỆT','account_number'=>'0501000161516','account_branch'=>'Ngân hàng VietinBank Chi Nhánh Bắc Sài Gòn','status'=>1],
            ['name'=>'Vietcombank','image'=>15,'account_name'=>'CÔNG TY TNHH TM & DV KỸ NGHỆ VIỆT','account_number'=>'0501000161516','account_branch'=>'Ngân hàng Vietcombank Chi Nhánh Bắc Sài Gòn','status'=>1],
        ];

        DB::table('bank')->insert($data);
    }
}
