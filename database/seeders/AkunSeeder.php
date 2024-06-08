<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $user = [
            [
                'name' => 'Imelda',
                'username' => 'imelda01',
                'email' => 'administrator@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'Administrator',
                'menu' => '1,2,3,4,5,6,7',
                'submenu' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36',
                'phone' => '08569789744',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Olivia Ajeng',
                'username' => 'olivia02',
                'email' => 'leader@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'Leader',
                'menu' => '1,2,3',
                'submenu' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24',
                'phone' => '0896566644',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Sinta',
                'username' => 'sinta03',
                'email' => 'customer@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'Customer',
                'menu' => '1,4',
                'submenu' => '25,26,27,28',
                'phone' => '0896547788',
                'email_verified_at' => Carbon::now(),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
