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

    protected $title = 'Faeyza Farma';
    protected $menu = 'Dashboard';

    public function index()
    {
        $today = Carbon::now();
        $penjualan = DB::table('penjualan')
            ->whereDate('created_at', $today)
            ->sum('total');

        $totalObat = DB::table('penjualan_detil')
            ->whereDate('created_at', $today)
            ->count('obat_id');

        $pembelian = DB::table('pembelian')
            ->whereDate('created_at', $today)
            ->sum('nilai_pembelian');

        $totalQty = DB::table('penjualan_detil')
            ->whereDate('created_at', $today)
            ->sum('qty');

        $supplier = SupplierModel::count();
        $user = User::whereNull('deleted_at')->count();
        // dd($pembelian);





        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Dashboard',
            'label' => 'Dashboard',
            'supplier' => $supplier,
            'jum_pembelian' => $pembelian,
            'jum_transaksi' => $penjualan,
            'jum_transaksi_detil' => $totalObat,
            'kuantiti' => $totalQty,
            'user' => $user,


        ];
        return view('dashboard.index')->with($data);
    }
}
