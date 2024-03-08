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
                'icon_menu' => 'bx bx-home-circle',
                'status' => '1',
                'order_menu' => '1',
                'created_at' => Carbon::now(),
            ],
            [
                'menu' => 'Master Data',
                // 'route_menu' => '',
                // 'typemenu' => '',
                'icon_menu' => 'bx bx-store',
                'status' => '1',
                'order_menu' => '2',
                'created_at' => Carbon::now(),
            ],
            [
                'menu' => 'Pembelian',
                // 'route_menu' => '',
                // 'typemenu' => '',
                'icon_menu' => 'bx bx-log-in-circle',
                'status' => '1',
                'order_menu' => '3',
                'created_at' => Carbon::now(),
            ],
            [
                'menu' => 'Penjualan',
                // 'route_menu' => '',
                // 'typemenu' => '',
                'icon_menu' => 'bx bx-dollar',
                'status' => '1',
                'order_menu' => '4',
                'created_at' => Carbon::now(),
            ],
            [
                'menu' => 'Laporan',
                // 'route_menu' => '',
                // 'typemenu' => '',
                'icon_menu' => 'bx bx-receipt',
                'status' => '1',
                'order_menu' => '5',
                'created_at' => Carbon::now(),
            ],
        ];

        foreach ($table_menu as $key => $value) {
            MenuModel::create($value);
        }
    }
}
