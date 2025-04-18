<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'fname' => 'Silon',
            'lname' => 'Rajthala',
            'mobilenumber' => '9803298969',
            'username' => 'clon',
            'email' => 'silon@gmail.com',
            'countrycode' => '977',
            'usertype' => '1',
            'isactive' => 'Y',
            'password'=>bcrypt('12345678')           
        ]);
    }
}
