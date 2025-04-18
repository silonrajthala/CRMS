<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['Dashboard', 'dashboard', 'fas fa-list', 1, 0],
            ['Preview', 'dashboard', 'fas fa-list', 1, 1],
            ['Cogs', '#', 'fas fa-list', 3, 0],
            ['Menu', 'menu', 'fas fa-list', 1, 3],
            ['Permission', 'permission', 'fas fa-cogs', 2, 3],
            ['Form Permission', 'permission/form', 'fas fa-cogs', 3, 3],
            ['User Group', 'usertype', 'fas fa-users', 2, 0],
            ['Users', 'user', 'fas fa-user', 3, 0],
        ];

        foreach ($data as $item) {
            DB::table('modules')->insert([
                'modulename' => $item[0],
                'url' => $item[1],
                'icon' => $item[2],
                'orderby' => $item[3],
                'parentmoduleid' => $item[4],
            ]);
        }
    }
}
