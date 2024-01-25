<?php

namespace App\Http\Controllers;

use App\Models\ObatModel;
use App\Models\PelangganModel;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    protected $title = 'Faeyza Farma';
    protected $menu = 'Penjualan';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $struka = PenjualanModel::latest()->first();
        // $strukb = BursaDetilPenjualan::where('id_penjualan', $struka->id)->get();
        // // dd($strukb);

        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Penjualan',
            'label' => 'data Penjualan',
            'penjualan' => PenjualanModel::all(),
            'obat' => ObatModel::all(),
            'pelanggan' => PelangganModel::all(),
            'detil_struk' => $struka
        ];
        return view('penjualan.penjualan')->with($data);
    }

    public function data_pelanggan(Request $request)
    {
        $pelanggan = PelangganModel::all();
        return response()->json($pelanggan);
    }

    public function obat_data_list()
    {

        $obatData = DB::table('obat')
            ->whereNull('deleted_at')
            ->get();


        if (count($obatData) > 0) {
            return response()->json([
                'code' => 200,
                'data' => $obatData,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        }
    }

    public function getObatDetails($id)
    {
        $obat = ObatModel::find($id);
        if ($obat) {
            return response()->json($obat);
        }

        return response()->json(['error' => 'Obat not found.'], 404);
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
    public function show(string $id)
    {
        //
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
