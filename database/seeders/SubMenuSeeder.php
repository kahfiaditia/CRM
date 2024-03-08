<?php

namespace Database\Seeders;

use App\Models\MenuModel;
use App\Models\SubMenuModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('table_submenu')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $table_submenu = [
            [
                'menu_id' => '2',
                'submenu' => 'List User',
                'route_submenu' => 'data_user.index',
                'typemenu' => 'view',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '2',
                'submenu' => 'List User',
                // 'route_submenu' => 'List User',
                'typemenu' => 'insert',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '2',
                'submenu' => 'List User',
                // 'route_submenu' => 'List User',
                'typemenu' => 'edit',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '2',
                'submenu' => 'Jenis',
                'route_submenu' => 'jenis.index',
                'typemenu' => 'view',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '2',
                'submenu' => 'Jenis',
                // 'route_submenu' => '',
                'typemenu' => 'insert',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '2',
                'submenu' => 'Jenis',
                // 'route_submenu' => '',
                'typemenu' => 'edit',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '2',
                'submenu' => 'Obat',
                'route_submenu' => 'obat.index',
                'typemenu' => 'view',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '2',
                'submenu' => 'Obat',
                // 'route_submenu' => '',
                'typemenu' => 'insert',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '2',
                'submenu' => 'Obat',
                // 'route_submenu' => '',
                'typemenu' => 'edit',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '2',
                'submenu' => 'Pelanggan',
                'route_submenu' => 'pelanggan.index',
                'typemenu' => 'view',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '2',
                'submenu' => 'Pelanggan',
                // 'route_submenu' => '',
                'typemenu' => 'insert',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '2',
                'submenu' => 'Pelanggan',
                // 'route_submenu' => '',
                'typemenu' => 'edit',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '3',
                'submenu' => 'Pembelian',
                'route_submenu' => 'pembelian.index',
                'typemenu' => 'view',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '3',
                'submenu' => 'Pembelian',
                // 'route_submenu' => '',
                'typemenu' => 'insert',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '3',
                'submenu' => 'Pembelian',
                // 'route_submenu' => '',
                'typemenu' => 'edit',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '4',
                'submenu' => 'Penjualan',
                'route_submenu' => 'penjualan.index',
                'typemenu' => 'view',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '4',
                'submenu' => 'Penjualan',
                // 'route_submenu' => '',
                'typemenu' => 'insert',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '4',
                'submenu' => 'Penjualan',
                // 'route_submenu' => '',
                'typemenu' => 'edit',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '5',
                'submenu' => 'Laporan Penjualan',
                'route_submenu' => 'laporan_penjualan.index',
                'typemenu' => 'view',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '5',
                'submenu' => 'Laporan Penjualan',
                // 'route_submenu' => '',
                'typemenu' => 'insert',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '5',
                'submenu' => 'Laporan Penjualan',
                // 'route_submenu' => '',
                'typemenu' => 'edit',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '5',
                'submenu' => 'Laporan Pembelian',
                'route_submenu' => 'laporan_penjualan.index',
                'typemenu' => 'view',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '5',
                'submenu' => 'Laporan Pembelian',
                // 'route_submenu' => '',
                'typemenu' => 'insert',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => '5',
                'submenu' => 'Laporan Pembelian',
                // 'route_submenu' => '',
                'typemenu' => 'edit',
                'status' => '1',
                'order_submenu' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($table_submenu as $key => $value) {
            SubMenuModel::create($value);
        }
    }
}
