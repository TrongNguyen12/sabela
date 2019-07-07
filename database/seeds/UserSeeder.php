<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'name'=>'gco_admin',
                'password'=>Hash::make('1a2s3d4f5g6h'),
                'email'=>'letien524@gmail.com',
                'image' => '1',
                'level'=>1,
            ],
            [
                'name'=>'admin',
                'password'=>Hash::make('12345678'),
                'email'=>'nvtrong393@gmail.com',
                'image' => '1',
                'level'=>1,
            ],

        ];
        DB::table('users')->insert($data);
    }
}
