<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\HistoryModel;
use App\Models\ObatModel;
use App\Models\PembelianDetilModel;
use App\Models\PembelianModel;
use App\Models\SupplierModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PembelianController extends Controller
{
    protected $title = 'Pembelian';
    protected $menu = 'Master Data';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Pembelian',
            'label' => 'List pembelian',
        ];
        return view('pembelian.index')->with($data);
    }

    public function data_list_pembelian(Request $request)
    {
        $userdata = DB::table('pembelian')
            ->select('pembelian.id', 'pembelian.kode_pembelian', 'pembelian.created_at', 'supplier.supplier as nama')
            ->leftJoin('supplier', 'pembelian.supplier_id', '=', 'supplier.id')
            ->whereNull('pembelian.deleted_at');
        // ->get();
        // dd($userdata);
        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $userdata->where(function ($where) use ($search) {
                $where
                    ->orWhere('supplier', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('kontak', 'like', '%' . $search . '%')
                    ->orWhere('telp', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });

            $search = $request->get('search');
            // $search_rak = str_replace(' ', '', $search);
            if ($search != null) {
                $userdata->where(function ($where) use ($search) {
                    $where
                        ->orWhere('supplier', 'like', '%' . $search . '%')
                        ->orWhere('alamat', 'like', '%' . $search . '%')
                        ->orWhere('kontak', 'like', '%' . $search . '%')
                        ->orWhere('telp', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            }
        } else {
            if ($request->get('supplier') != null) {
                $supplier = $request->get('supplier');
                $userdata->where('supplier', '=', $supplier);
            }
            if ($request->get('alamat') != null) {
                $alamat = $request->get('alamat');
                $userdata->where('alamat', '=', $alamat);
            }
            if ($request->get('kontak') != null) {
                $kontak = $request->get('kontak');
                $userdata->where('kontak', '=', $kontak);
            }
            if ($request->get('telp') != null) {
                $telp = $request->get('telp');
                $userdata->where('telp', '=', $telp);
            }
        }

        return DataTables::of($userdata)
            ->addColumn('action', 'pembelian.aksi')
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Input pembelian',
            'label' => 'Input pembelian',
            'supplierdata' => SupplierModel::all(),
        ];
        return view('pembelian.input')->with($data);
    }

    public function mengambil_data_obat(Request $request)
    {
        $obatData = ObatModel::all();
        return response()->json($obatData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->datapembelian);
        DB::beginTransaction();
        try {
            $currentDate = date('ymd');
            // Mencari jumlah transaksi dengan tanggal yang sama
            $query = "SELECT COUNT(*) as total FROM pembelian WHERE DATE_FORMAT(created_at, '%y%m%d') = '{$currentDate}'";
            $result = DB::select($query);
            // Mendapatkan jumlah transaksi dengan tanggal yang sama
            $totalTransactions = $result[0]->total + 1;
            // Membuat nomor urut dengan format 3 digit (contoh: 001, 002, dst.)
            $transactionNumber = sprintf('%03d', $totalTransactions);
            // Menggabungkan semua elemen menjadi kode transaksi
            $transactionCode = "PM" . $currentDate  . $transactionNumber;
            // Memastikan kode transaksi unik
            while ($existingTransaction = PembelianModel::where('kode_pembelian', $transactionCode)->first()) {
                $totalTransactions++;
                $transactionNumber = sprintf('%03d', $totalTransactions);
                $transactionCode = "PM" . $currentDate . $transactionNumber;
            }

            $tambahandata = $request->tambahandata[0];
            $dataPembelian = $request->datapembelian[0];

            $pembelian = new PembelianModel();
            $pembelian->kode_pembelian = $transactionCode;
            $pembelian->tgl_kedatangan = $dataPembelian['tgl_kedatangan'];
            $pembelian->nomor_do = $dataPembelian['nomor_do'];
            $pembelian->supplier_id = $dataPembelian['supplier'];
            // $pembelian->total_produk = $dataPembelian['supplier'];
            $pembelian->ongkir = $tambahandata['ongkir'];
            $pembelian->nilai_pembelian = $tambahandata['potongan'];
            $pembelian->potongan = $tambahandata['potongan'];
            $pembelian->keterangan = $tambahandata['potongan'];
            $pembelian->status_pembayaran = is_null($tambahandata['status_pembayaran']) ? 1 : $tambahandata['status_pembayaran'];
            $pembelian->user_created = Auth::user()->id;
            $pembelian->save();

            $maxId = PembelianModel::max('id');
            $pembelian->id = $maxId;

            $obatQuantities = [];

            for ($i = 0; $i < count($request->datapembelian); $i++) {
                // Convert 'harga_total_produk' to a double
                $harga_total_produk = floatval(str_replace('.', '', $request->datapembelian[$i]['harga_total_produk']));

                // Convert 'nilai_jual' to a double
                $nilai_jual = floatval(str_replace('.', '', $request->datapembelian[$i]['nilai_jual']));

                $harga_per_pcs = $request->datapembelian[$i]['harga_per_pcs'];
                $hilang_comma = str_replace(',', '', $harga_per_pcs);
                $request_double = (float) $hilang_comma;

                // Convert 'harga_per_pcs' to a double
                $produk = new PembelianDetilModel();
                $produk->pembelian_id = $pembelian->id;
                $produk->kadaluarsa = $request->datapembelian[$i]['tgl_kadaluarsa'];
                $produk->produk_id = $request->datapembelian[$i]['obat'];
                $produk->harga_total_produk =  $harga_total_produk;
                $produk->total_kuantiti = $request->datapembelian[$i]['total_kuantiti'];
                $produk->nilai_per_pcs =  $request_double;
                $produk->nilai_jual = $nilai_jual;
                $produk->user_created = Auth::user()->id;
                $produk->save();

                $stokp = new HistoryModel();
                $stokp->keterangan = "Pembelian";
                $stokp->pembelian_id = $pembelian->id;
                $stokp->obat_id = $request->datapembelian[$i]['obat'];
                $stokp->qty = $request->datapembelian[$i]['total_kuantiti'];
                $stokp->harga_beli =  $request_double;
                $stokp->harga_jual = $nilai_jual;
                $stokp->user_created = Auth::user()->id;
                $stokp->save();

                $obat_id = $request->datapembelian[$i]['obat'];
                $quantity = $request->datapembelian[$i]['total_kuantiti'];
                $harga_beli = $request_double;
                $harga_jual = $nilai_jual;

                if (!isset($obatQuantities[$obat_id])) {
                    $obatQuantities[$obat_id] = [
                        'quantity' => 0,
                        'harga_beli' => 0,
                        'harga_jual' => 0,
                    ];
                }

                $obatQuantities[$obat_id]['quantity'] += $quantity;
                $obatQuantities[$obat_id]['harga_beli'] = $harga_beli; // Update harga_beli directly
                $obatQuantities[$obat_id]['harga_jual'] = $harga_jual;
            }

            foreach ($obatQuantities as $obat_id => $data) {
                // Find the obat with the given obat_id
                $obat = ObatModel::find($obat_id);

                // Check if the obat with the given obat_id exists
                if ($obat) {
                    // Update the stock, harga_beli, and harga_jual
                    $obat->stok += $data['quantity'];
                    $obat->harga_beli = $data['harga_beli'];
                    $obat->harga_jual = $data['harga_jual'];
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
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Edit supplier',
            'label' => 'Edit supplier',
            'editsuplier' => PembelianModel::findOrfail($id)
        ];
        return view('supplier.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
            'telp' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $produk = PembelianModel::findOrFail($id);
            $produk->supplier = $request->supplier;
            $produk->alamat = $request->alamat;
            $produk->kontak = $request->kontak;
            $produk->telp = $request->telp;
            $produk->status = $request->status1;
            $produk->user_updated = Auth::user()->id;
            $produk->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/supplier');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $hapus = PembelianModel::findOrFail($id);
            $hapus->deleted_at = Carbon::now();
            $hapus->user_deleted = Auth::user()->id;
            $hapus->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/supplier');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }
}
