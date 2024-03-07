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
                'name' => 'Riki',
                'email' => 'administrator@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'Administrator',
                'menu' => '1,2',
                'submenu' => '1,2,3',
                'phone' => '08569789744',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Olivia Ajeng',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'Admin',
                'menu' => '1,2',
                'submenu' => '1,2,3',
                'phone' => '0896566644',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Sinta',
                'email' => 'kasir@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'Kasir',
                'menu' => '1,2',
                'submenu' => '1,2,3',
                'phone' => '0896547788',
                'email_verified_at' => Carbon::now(),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
