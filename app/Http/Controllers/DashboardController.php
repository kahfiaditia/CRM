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
               

        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Dashboard',
            'label' => 'Dashboard',

        ];
        return view('dashboard.index')->with($data);
    }
}
