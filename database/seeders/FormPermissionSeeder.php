<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FormPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data=[ 
            [
            'formname' => 'User Group',
             'slug'=>'user-group',
             'isinsert'=>'Y',
             'isupdate'=>'Y',
             'isedit'=>'Y',
             'isdelete'=>'Y',
             'usertypeid'=>'1'
            ],
            [
                'formname' => 'Users',
                 'slug'=>'users',
                 'isinsert'=>'Y',
                 'isupdate'=>'Y',
                 'isedit'=>'Y',
                 'isdelete'=>'Y',
                 'usertypeid'=>'1'
            ],
            [
                'formname' => 'Request Mobile Number',
                 'slug'=>'request-mobile-number',
                 'isinsert'=>'Y',
                 'isupdate'=>'Y',
                 'isedit'=>'Y',
                 'isdelete'=>'Y',
                 'usertypeid'=>'1'
            ]
            ,
            [
                'formname' => 'Request Card Activation & Green Pin',
                 'slug'=>'request-card-activation',
                 'isinsert'=>'Y',
                 'isupdate'=>'Y',
                 'isedit'=>'Y',
                 'isdelete'=>'Y',
                 'usertypeid'=>'1'
            ]
            ,
            [
                'formname' => 'Account Update',
                 'slug'=>'account-update',
                 'isinsert'=>'Y',
                 'isupdate'=>'Y',
                 'isedit'=>'Y',
                 'isdelete'=>'Y',
                 'usertypeid'=>'1'
            ]
            ,
            [
                'formname' => 'Card Status Update',
                 'slug'=>'card-status-update',
                 'isinsert'=>'Y',
                 'isupdate'=>'Y',
                 'isedit'=>'Y',
                 'isdelete'=>'Y',
                 'usertypeid'=>'1'
            ]
        ];

        foreach ($data as $item) {
            DB::table('form_permission')->insert($item);
        }
    
    }
}
