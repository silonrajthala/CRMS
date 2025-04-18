<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('usertype')->insert(
            [
            'typename' => 'SuperAdmin',
            ]
        );

        DB::table('usertype')->insert(
            [
            'typename' => 'Admin',
            ]
        );

        DB::table('usertype')->insert(
            [
            'typename' => 'Customer',
            ]
        );
    }
}
