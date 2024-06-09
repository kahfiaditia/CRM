<?php

namespace Database\Seeders;

use App\Models\MenuModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('table_menu')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $table_menu = [
            [
                'menu' => 'Dashboard',
                'route_menu' => 'dashboard',
                'typemenu' => 'view',
                'icon_menu' => 'bx bx-home font-size-24 text-warning',
                'status' => '1',
                'order_menu' => '1',
                'created_at' => Carbon::now(),
            ],
            [
                'menu' => 'User',
                'route_menu' => 'data_user.index',
                'typemenu' => 'view',
                'icon_menu' => 'bx bx-user font-size-24 text-warning',
                'status' => '1',
                'order_menu' => '2',
                'created_at' => Carbon::now(),
            ],
            [
                'menu' => 'Profil',
                'route_menu' => 'data_user.index',
                'typemenu' => 'view',
                'icon_menu' => 'bx bx-user font-size-24 text-warning',
                'status' => '1',
                'order_menu' => '3',
                'created_at' => Carbon::now(),
            ],
            [
                'menu' => 'Master Data',
                // 'route_menu' => '',
                // 'typemenu' => '',
                'icon_menu' => 'bx bx-slider font-size-24 text-warning',
                'status' => '1',
                'order_menu' => '4',
                'created_at' => Carbon::now(),
            ],
            [
                'menu' => 'Pelaporan',
                // 'route_menu' => '',
                // 'typemenu' => '',
                'icon_menu' => 'bx bx-basket font-size-24 text-warning',
                'status' => '1',
                'order_menu' => '5',
                'created_at' => Carbon::now(),
            ],
            [
                'menu' => 'Penanganan',
                // 'route_menu' => '',
                // 'typemenu' => '',
                'icon_menu' => 'bx bx-basket font-size-24 text-warning',
                'status' => '1',
                'order_menu' => '6',
                'created_at' => Carbon::now(),
            ],
            [
                'menu' => 'Laporan',
                // 'route_menu' => '',
                // 'typemenu' => '',
                'icon_menu' => 'bx bx-copy font-size-24 text-warning',
                'status' => '1',
                'order_menu' => '7',
                'created_at' => Carbon::now(),
            ],
        ];

        foreach ($table_menu as $key => $value) {
            MenuModel::create($value);
        }
    }
}
