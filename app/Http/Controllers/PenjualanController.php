<?php

namespace App\Http\Controllers;

use App\Models\HistoryModel;
use App\Models\ObatModel;
use App\Models\PelangganModel;
use App\Models\PenjualanDetilModel;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('26', $session_menu)) {

            $struka = PenjualanModel::latest()->first();

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
        } else {
            return view('not_found');
        }
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
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('26', $session_menu)) {
            DB::beginTransaction();
            try {

                $currentDate = date('ymd');
                // Mencari jumlah transaksi dengan tanggal yang sama
                $query = "SELECT COUNT(*) as total FROM penjualan WHERE DATE_FORMAT(created_at, '%y%m%d') = '{$currentDate}'";
                $result = DB::select($query);
                // Mendapatkan jumlah transaksi dengan tanggal yang sama
                $totalTransactions = $result[0]->total + 1;
                // Membuat nomor urut dengan format 3 digit (contoh: 001, 002, dst.)
                $transactionNumber = sprintf('%03d', $totalTransactions);
                // Menggabungkan semua elemen menjadi kode transaksi
                $transactionCode = "PJ" . $currentDate  . $transactionNumber;
                // Memastikan kode transaksi unik
                while ($existingTransaction = PenjualanModel::where('kode_penjualan', $transactionCode)->first()) {
                    $totalTransactions++;
                    $transactionNumber = sprintf('%03d', $totalTransactions);
                    $transactionCode = "PJ" . $currentDate . $transactionNumber;
                }

                $requestData = $request->all();

                // Extract additional data
                $additionalData = $requestData['additionalData'];
                $id_pembeli = $additionalData['id_pembeli'];
                $jenis_pembayaran = $additionalData['jenis_pembayaran'];
                $keterangan1 = $additionalData['keterangan1'];

                // Extract product data
                $tableData = $requestData['tableData'];

                // Validate and save additional data to Penjualan model
                $penjualan = new PenjualanModel();
                $penjualan->kode_penjualan = $transactionCode;
                $penjualan->pelanggan_id = $id_pembeli;
                $penjualan->keterangan = $keterangan1;
                $penjualan->user_created = Auth::user()->id;
                $penjualan->save();

                $maxId = PenjualanModel::max('id');
                $penjualan->id = $maxId;

                // Validate and save each product data
                foreach ($tableData as $rowData) {
                    // $id = $rowData['id'];
                    $harga_jual  = str_replace(',', '', $rowData['harga']);
                    $total = str_replace(',', '', $rowData['total']);
                    $harga_beli = str_replace(',', '', $rowData['modal']);

                    $penjualandetil = new PenjualanDetilModel(); // Create a new Penjualan instance for each product
                    $penjualandetil->penjualan_id =  $penjualan->id;
                    $penjualandetil->obat_id = $rowData['id'];
                    $penjualandetil->qty = $rowData['qty'];
                    $penjualandetil->harga_jual =  $harga_jual;
                    $penjualandetil->harga_beli =  $harga_beli;
                    $penjualandetil->total = $total;
                    $penjualandetil->user_created = Auth::user()->id;
                    $penjualandetil->save();

                    $count_total_produk = PenjualanDetilModel::where('penjualan_id', $penjualan->id)->count();
                    PenjualanModel::where('id',  $penjualan->id)->update(['total_produk' => $count_total_produk]);

                    $totalSum = PenjualanDetilModel::where('penjualan_id', $penjualan->id)->sum('total');
                    PenjualanModel::where('id',  $penjualan->id)->update(['total' => $totalSum]);

                    $stokp = new HistoryModel();
                    $stokp->keterangan = "Penjualan";
                    $stokp->penjualan_id = $penjualan->id;
                    $stokp->obat_id = $rowData['id'];
                    $stokp->qty = $rowData['qty'];
                    $stokp->harga_beli =   $harga_beli;
                    $stokp->harga_jual = $harga_jual;
                    $penjualandetil->total = $total;
                    $stokp->user_created = Auth::user()->id;
                    $stokp->save();

                    $obatId = $rowData['id'];

                    // Menghitung total qty penjualan per obat_id
                    $totalQtyPenjualan = HistoryModel::where('obat_id', $obatId)
                        ->where('keterangan', 'Penjualan')
                        ->where('penjualan_id', $penjualan->id)
                        ->sum('qty');

                    // Mengupdate stok pada model ObatModel
                    $obat = ObatModel::find($obatId);

                    if ($obat) {
                        // Mengurangkan stok berdasarkan total qty penjualan
                        $obat->stok -= $totalQtyPenjualan;
                        $obat->save();
                    }
                }

                DB::commit();
                return response()->json([
                    'code' => 200,
                    'message' => 'Berhasil Input Data',
                ]);
            } catch (\Throwable $err) {
                DB::rollBack();
                throw $err;
                return response()->json([
                    'code' => 404,
                    'message' => 'Gagal Input Data',
                ]);
            }
        } else {
            return view('not_found');
        }
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
