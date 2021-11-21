<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            ['email'=>'admin1@gmail.com','password'=>Hash::make('7250340'),'name'=>'Nguyễn Việt Hân','phone'=>'0382484093','isActive'=>1,'role'=>2],
            ['email'=>'admin2@gmail.com','password'=>Hash::make('7250340'),'name'=>'Nguyễn Việt Hân','phone'=>'0382484093','isActive'=>1,'role'=>2]
        ]);
    }
}
