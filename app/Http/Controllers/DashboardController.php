<?php

namespace App\Http\Controllers;

use App\Models\PelangganModel;
use App\Models\PembelianModel;
use App\Models\PenjualanModel;
use App\Models\SupplierModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    protected $title = 'Dashboard';
    protected $menu = 'Dashboard';

    public function index()
    {
        $today = Carbon::now();
        $users = DB::table('users')
            ->whereDate('created_at', $today)
            ->count('id');
        $totalRoles = DB::table('users')
               ->select(DB::raw('COUNT(DISTINCT roles) AS total_roles'))
               ->first();
        $users1 = DB::table('users')
            ->count('id');
        $satuan_jumlah = DB::table('satuan')
            ->count('id');
        $supplier_jumlah = DB::table('supplier')
            ->count('id');
        $produk_jumlah = DB::table('produk')
            ->count('id');
        $pelanggan_jumlah = DB::table('pelanggan')
            ->count('id');

        

        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Dashboard',
            'label' => 'Dashboard',
            'total_roles' => $totalRoles,
            'user_jumlah' => $users1,
            'satuan_jumlah' => $satuan_jumlah,
            'supplier_jumlah' => $supplier_jumlah,
            'produk_jumlah' => $produk_jumlah,
            'pelanggan_jumlah' => $pelanggan_jumlah,

        ];
        return view('dashboard.index')->with($data);
    }
}
