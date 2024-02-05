<?php

namespace App\Http\Controllers;

use App\Models\PenjualanDetilModel;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LaporanPenjualanController extends Controller
{
    protected $title = 'Laporan Penjualan';
    protected $menu = 'Master Data';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Laporan',
            'label' => 'List Laporan',
            'transaksi' => PenjualanModel::all()
        ];
        return view('laporan_penjualan.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ide_decrypted = Crypt::decryptString($id);
        $penjualan = PenjualanModel::findOrfail($ide_decrypted);
        $detil_penjualan = PenjualanDetilModel::where('penjualan_id', $penjualan->id)->get();
        $count = PenjualanDetilModel::where('penjualan_id', $penjualan->id)->count();
        $total_penjualan = PenjualanDetilModel::where('penjualan_id', $penjualan->id)->sum('total');
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Laporan',
            'label' => 'List Laporan',
            'penjualan' => $penjualan,
            'detil_penjualan' =>  $detil_penjualan,
            'count' =>  $count,
            'total' =>  $total_penjualan,
        ];
        return view('laporan_penjualan.lihat')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
