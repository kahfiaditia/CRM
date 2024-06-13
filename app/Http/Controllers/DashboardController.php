<?php

namespace App\Http\Controllers;

use App\Models\AplikasiModel;
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
        $customer = PelangganModel::whereDate('created_at', $today)->count();
        $j_customer = PelangganModel::count();

        $leader = User::whereDate('created_at', $today)
            ->where('roles', 'Leader')
            ->count();

        $j_leader = User::where('roles', 'Leader')
            ->count();

        $aplikasi = AplikasiModel::whereDate('created_at', $today)->count();
        $j_aplikasi = AplikasiModel::count();


        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Dashboard',
            'label' => 'Dashboard',
            'customer_jumlah' => $customer,
            'customer_count' => $j_customer,
            'leader_jumlah' => $leader,
            'leader_count' => $j_leader,
            'aplikasi_jumlah' => $aplikasi,
            'aplikasi_count' => $j_aplikasi,
        ];
        return view('dashboard.index')->with($data);
    }
}
