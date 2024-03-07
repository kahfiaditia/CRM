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
                'status' => '1',
                'order_menu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu' => 'Master Data',
                'status' => '1',
                'order_menu' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu' => 'Pembelian',
                'status' => '1',
                'order_menu' => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu' => 'Penjualan',
                'status' => '1',
                'order_menu' => '4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu' => 'Laporan',
                'status' => '1',
                'order_menu' => '5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($table_menu as $key => $value) {
            MenuModel::create($value);
        }
    }
}
