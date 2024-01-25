<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\ObatModel;
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

    public function data_list(Request $request)
    {
        $userdata = DB::table('pembelian')
            ->whereNull('deleted_at');
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
            ->addColumn('action', 'supplier.aksi')
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
        dd($request->datapembelian);
        // DB::beginTransaction();
        // try {
        //     $currentDate = date('ymd');
        //     // Mencari jumlah transaksi dengan tanggal yang sama
        //     $query = "SELECT COUNT(*) as total FROM pembelian WHERE DATE_FORMAT(created_at, '%y%m%d') = '{$currentDate}'";
        //     $result = DB::select($query);
        //     // Mendapatkan jumlah transaksi dengan tanggal yang sama
        //     $totalTransactions = $result[0]->total + 1;
        //     // Membuat nomor urut dengan format 3 digit (contoh: 001, 002, dst.)
        //     $transactionNumber = sprintf('%03d', $totalTransactions);
        //     // Menggabungkan semua elemen menjadi kode transaksi
        //     $transactionCode = "PM" . $currentDate  . $transactionNumber;
        //     // Memastikan kode transaksi unik
        //     while ($existingTransaction = PembelianModel::where('kode_transaksi', $transactionCode)->first()) {
        //         $totalTransactions++;
        //         $transactionNumber = sprintf('%03d', $totalTransactions);
        //         $transactionCode = "PM" . $currentDate . $transactionNumber;
        //     }

        //     $tambahandata = $request->tambahandata[0];
        //     $dataPembelian = $request->datapembelian[0];

        //     $pembelian = new PembelianModel();
        //     $pembelian->kode_transaksi = $transactionCode;
        //     $pembelian->tgl_permintaan = $dataPembelian['tgl_permintaan'];
        //     $pembelian->tgl_kedatangan = $dataPembelian['tgl_kedatangan'];
        //     $pembelian->note = $dataPembelian['status_pembelian'];
        //     $pembelian->nomor_do = $dataPembelian['nomor_do'];
        //     $pembelian->id_supplier = $dataPembelian['supplier'];
        //     $pembelian->ongkir = $tambahandata['ongkir'];
        //     $pembelian->potongan = $tambahandata['potongan'];
        //     $pembelian->status_pembayaran = is_null($tambahandata['status_pembayaran']) ? 1 : $tambahandata['status_pembayaran'];
        //     $pembelian->user_created = Auth::user()->id;
        //     $pembelian->save();

        //     $maxId = PembelianModel::max('id');
        //     $pembelian->id = $maxId;

        //     for ($i = 0; $i < count($request->datapembelian); $i++) {
        //         // Convert 'harga_total_produk' to a double
        //         $harga_total_produk = floatval(str_replace('.', '', $request->datapembelian[$i]['harga_total_produk']));

        //         // Convert 'nilai_jual' to a double
        //         $nilai_jual = floatval(str_replace('.', '', $request->datapembelian[$i]['nilai_jual']));

        //         $harga_per_pcs = $request->datapembelian[$i]['harga_per_pcs'];
        //         $hilang_comma = str_replace(',', '', $harga_per_pcs);
        //         $request_double = (float) $hilang_comma;

        //         // Convert 'harga_per_pcs' to a double
        //         $produk = new BursaDetilPembelian();
        //         $produk->id_pembelian = $pembelian->id;
        //         $produk->id_produk = $request->datapembelian[$i]['produk'];
        //         $produk->kadaluarsa = $request->datapembelian[$i]['tgl_kadaluarsa'];
        //         $produk->harga_total_produk =  $harga_total_produk;
        //         $produk->total_kuantiti = $request->datapembelian[$i]['total_kuantiti'];
        //         $produk->nilai_per_pcs =  $request_double;
        //         $produk->nilai_jual = $nilai_jual;
        //         $produk->user_created = Auth::user()->id;
        //         $produk->save();

        //         $stokp = new BursaStokProduk();
        //         $stokp->id_p =  $pembelian->id;
        //         $stokp->id_detil_p = $produk->id;
        //         $stokp->id_produk = $request->datapembelian[$i]['produk'];
        //         $stokp->qty = $request->datapembelian[$i]['total_kuantiti'];
        //         $stokp->beli =  $request_double;
        //         $stokp->jual = $nilai_jual;
        //         $stokp->user_created = Auth::user()->id;
        //         $stokp->save();

        //         $unix = $request->datapembelian[$i]['produk'];
        //         $stokin = BursaStokProduk::where('id_produk', $unix)
        //             ->whereNull('deleted_at')
        //             ->sum('qty');

        //         $stokout = BursaStokKeluarProduk::where('id_produk', $unix)
        //             ->whereNull('deleted_at')
        //             ->sum('qty_jual');

        //         $hasilstok = $stokin - $stokout;

        //         DB::table('bursa_produks')
        //             ->where('id', $unix)
        //             ->update([
        //                 'stok' =>  $hasilstok,
        //                 'harga_jual' => $nilai_jual,
        //                 'harga_beli' => $request_double,
        //                 'user_updated' => auth::user()->id
        //             ]);

        //         // Update the 'total_produk' field in the BursaPembelian setelah the loop
        //         $total_produk = BursaDetilPembelian::where('id_pembelian', $pembelian->id)->count();
        //         $sumHargaTotalProduk = BursaDetilPembelian::where('id_pembelian',  $pembelian->id)
        //             ->whereNull('deleted_at')
        //             ->sum('harga_total_produk');

        //         DB::table('bursa_pembelians')
        //             ->where('id', $pembelian->id)
        //             ->update([
        //                 'total_produk' =>  $total_produk,
        //                 'total_nilai' =>  $sumHargaTotalProduk,
        //                 'user_updated' => auth::user()->id
        //             ]);
        //     }

        //     DB::commit();
        //     return response()->json([
        //         'code' => 200,
        //         'message' => 'Berhasil Input Data',
        //     ]);
        // } catch (\Throwable $err) {
        //     DB::rollBack();
        //     throw $err;
        //     return response()->json([
        //         'code' => 404,
        //         'message' => 'Gagal Input Data',
        //     ]);
        // }
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
