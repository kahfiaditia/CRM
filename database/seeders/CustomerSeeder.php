<?php

namespace Database\Seeders;

use App\Models\PelangganModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('pelanggan')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $pelanggan = [
            [
                'nama' => 'Sinta',
                'email' => 'customer@gmail.com',
                'ar' => 1,
                'menu' => '3,4,5',
                'submenu' => '1,2,3,4,5,7,8,9,10,11,12,17,18,19,20',
                'telp' => '0896547788',
            ],
        ];

        foreach ($pelanggan as $key => $value) {
            PelangganModel::create($value);
        }
    }
}
