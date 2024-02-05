<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\HistoryModel;
use App\Models\ObatModel;
use App\Models\PembelianDetilModel;
use App\Models\PembelianModel;
use App\Models\SupplierModel;
use Carbon\Carbon;
use DateTime;
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
            // $pembelian->nilai_pembelian = $tambahandata['potongan'];
            $pembelian->potongan = $tambahandata['potongan'];
            // $pembelian->keterangan = $tambahandata['potongan'];
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

                $result = PembelianDetilModel::selectRaw('SUM(harga_total_produk) as totalHarga, COUNT(produk_id) as totalProduk')
                    ->where('pembelian_id', $pembelian->id)
                    ->first();

                if ($result) {
                    // Mengupdate nilai_pembelian dan total_produk pada model PembelianModel
                    $pembelian->nilai_pembelian = $result->totalHarga;
                    $pembelian->total_produk = $result->totalProduk;
                    $pembelian->save();
                }

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
        $pembeliancari = PembelianModel::where('id', $id)->first();
        $detilpembelian = PembelianDetilModel::where('pembelian_id', $pembeliancari->id)->get();
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'View Pembelian',
            'label' => 'View Pembelian',
            'pembelian' => $pembeliancari,
            'detilpembelian' => $detilpembelian
        ];
        return view('pembelian.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pembeliancari = PembelianModel::where('id', $id)->first();
        $detilpembelian = PembelianDetilModel::where('pembelian_id', $pembeliancari->id)->get();
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Edit Pembelian',
            'label' => 'Edit Pembelian',
            'supplier' => SupplierModel::all(),
            'editpembelian' => PembelianModel::findOrfail($id),
            'detilpembelian' => $detilpembelian,
            'barang' => DB::table('obat')->select('*')->whereNull('deleted_at')->get(),
        ];
        return view('pembelian.edit')->with($data);
    }
    public function ambil_dataproduk(Request $request)
    {
        $count = count($request->selectedProductIds);
        $allProducts = DB::table('obat')
            ->whereNotIn('id', $request->selectedProductIds)
            ->get();

        if ($allProducts->isNotEmpty()) {
            return response()->json([
                'code' => 200,
                'data' => $allProducts,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        }
    }

    public function edit_bursa_pembelian(Request $request)
    {
        // dd($request->dataSemua);
        DB::beginTransaction();
        try {
            $detilArray = [];
            foreach ($request->dataSemua as $itemArray) {
                foreach ($itemArray as $item) {
                    $kode = $item['kode'];
                    $detil = $item['detil'];
                    $produk3 = $item['produk'];
                    $detilArray[] = $detil;
                    $detilArray[] = $produk3;
                    $produk = $item['produk'];
                    $kuantiti = $item['kuantiti'];
                    $kadaluarsa = $item['kadaluarsa'];
                    $harga = $item['harga'];
                    $harsat = $item['harsat'];
                    $harjual = $item['harjual'];

                    if ($detil == 0) {
                        // Cek apakah id_pembelian dan id_produk apakah sudah ada dalam database?
                        $sudahada = PembelianDetilModel::where('pembelian_id', $kode)
                            ->where('produk_id', $produk)
                            ->first();

                        $stok_produk = HistoryModel::where('pembelian_id', $kode)
                            ->where('obat_id', $produk)
                            ->first();

                        // Jika produk sudah ada didatabase, update field dibawah
                        if ($sudahada) {

                            //buat formatter tanggal
                            $akuadalah = $kadaluarsa;
                            $tanggal_seharusnya = DateTime::createFromFormat('m/d/Y', $akuadalah);
                            $iniformatnya = $tanggal_seharusnya->format('Y-m-d');
                            $sudahada->kadaluarsa = $iniformatnya;

                            $sudahada->total_kuantiti = $kuantiti;
                            $sudahada->harga_total_produk = $harga;
                            $sudahada->nilai_per_pcs = $harsat;
                            $sudahada->nilai_jual = $harjual;
                            $sudahada->user_updated =  Auth::user()->id;
                            $sudahada->save();

                            //jika tidak ada
                        } else {
                            $inputtambahan = new PembelianDetilModel();
                            $inputtambahan->pembelian_id = $kode;
                            $inputtambahan->produk_id = $produk;
                            $inputtambahan->kadaluarsa = $kadaluarsa;

                            //buat formatter tanggal
                            $jadikandatetime = $kadaluarsa;
                            $datetimeObj = DateTime::createFromFormat('m/d/Y', $jadikandatetime);
                            $iniformatnya = $datetimeObj->format('Y-m-d');

                            $inputtambahan->kadaluarsa = $iniformatnya;
                            $inputtambahan->harga_total_produk = $harga;
                            $inputtambahan->total_kuantiti  = $kuantiti;
                            $inputtambahan->nilai_per_pcs = $harsat;
                            $inputtambahan->nilai_jual = $harjual;
                            $inputtambahan->user_created =  Auth::user()->id;
                            $inputtambahan->save();
                        }

                        if ($stok_produk) {
                            $stok_produk->qty = $kuantiti;
                            $stok_produk->beli = $harsat;
                            $stok_produk->jual = $harjual;
                            $stok_produk->user_updated =  Auth::user()->id;
                            $stok_produk->save();
                        } else {
                            $produkbaru = new HistoryModel();
                            $produkbaru->id_pembelian = $kode;
                            $produkbaru->obat_id = $produk;
                            $produkbaru->qty  = $kuantiti;
                            $produkbaru->beli = $harsat;
                            $produkbaru->jual = $harjual;
                            $produkbaru->user_created =  Auth::user()->id;
                            $produkbaru->save();
                        }
                    } else {
                        DB::table('pembelian_detil')
                            ->where('id', $detil)
                            ->update([
                                //ini semua field di bursa_detil_pembelian,
                                'kadaluarsa' => $kadaluarsa,
                                'produk_id' => $produk,
                                'harga_total_produk' => $harga,
                                'total_kuantiti' => $kuantiti,
                                'nilai_per_pcs' => $harsat,
                                'nilai_jual' => $harjual,
                                'user_updated' => Auth::user()->id,
                            ]);

                        DB::table('history')
                            ->where('pembelian_id', $kode)
                            ->update([
                                'obat_id' => $produk,
                                'qty' => $kuantiti,
                                'harga_beli' => $harsat,
                                'harga_jual' => $harjual,
                                'user_updated' => Auth::user()->id,
                            ]);

                        $totalQtyPembelian = HistoryModel::where('obat_id', $produk)
                            ->where('keterangan', 'Pembelian')
                            ->sum('qty');

                        $totalQtyPenjualan = HistoryModel::where('obat_id', $produk)
                            ->where('keterangan', 'Penjualan')
                            ->sum('qty');

                        $stokbaru = $totalQtyPembelian - $totalQtyPenjualan;
                        $obat = ObatModel::find($produk);

                        if ($obat) {
                            $obat->harga_beli = $harsat;
                            $obat->harga_jual = $harjual;
                            $obat->stok = $stokbaru;
                            $obat->save();
                        }
                    }
                }
            }

            foreach ($request->dataheader as $header) {
                $purchase_id = $header['purchase_id'];
                $kode_transaksi = $header['kode_transaksi'];
                $tgl_kedatangan = $header['tgl_kedatangan'];
                $supplier = $header['supplier'];
                $suratjalan = $header['suratjalan'];
                $pembayaran = $header['pembayaran'];

                //manipulasi data potongan
                $potongan = $header['potongan'];
                $hasilpotongan = str_replace(".", "", $potongan);

                $keterangan = $header['keterangan'];

                //manipulasi data ongkir
                $ongkir = $header['ongkir'];
                $hasilongkir = str_replace(".", "", $ongkir);

                $totalproduk =  DB::table('pembelian_detil')
                    ->where('pembelian_id', $purchase_id)
                    ->count();

                $hargaTotal = PembelianDetilModel::where('pembelian_id', $purchase_id)
                    ->sum('harga_total_produk');


                $datautama = PembelianModel::find($purchase_id);

                $datautama->kode_pembelian  = $kode_transaksi;
                $datautama->tgl_kedatangan  = $tgl_kedatangan;
                $datautama->supplier_id  = $supplier;
                $datautama->nomor_do  = $suratjalan;
                $datautama->total_produk  = $totalproduk;
                $datautama->nilai_pembelian  = $hargaTotal;
                $datautama->ongkir  = $hasilongkir;
                $datautama->potongan  =   $hasilpotongan;
                $datautama->status_pembayaran  =    $pembayaran;
                $datautama->keterangan  =   $keterangan;
                $datautama->user_updated  = Auth::user()->id;
                $datautama->save();
            }

            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'Berhasil Edit',
            ]);
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            return response()->json([
                'code' => 404,
                'message' => 'Gagal Edit',
            ]);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $delete = PembelianDetilModel::findorfail($id);
            $delete->user_deleted = Auth::user()->id;
            $delete->deleted_at = Carbon::now();
            $delete->save();

            $delete_stok = HistoryModel::where('id_detil_p', $id)->first();
            $delete_stok->user_deleted = Auth::user()->id;
            $delete_stok->deleted_at = Carbon::now();
            $delete_stok->save();

            $stokMasuk = DB::table('bursa_stok_produk')
                ->select('id_produk', DB::raw('SUM(qty) as total_qty_a'))
                ->whereNull('deleted_at')
                ->groupBy('id_produk')
                ->get();

            // Mengambil data stok keluar (qty_b) berdasarkan id_produk
            $stokKeluar = DB::table('bursa_keluar_produk')
                ->select('id_produk', DB::raw('SUM(qty_jual) as total_qty_b'))
                ->whereNull('deleted_at')
                ->groupBy('id_produk')
                ->get();

            // Update stok, harga_beli_real, dan harga_jual_real pada tabel produk_tabel
            foreach ($stokMasuk as $stok) {
                $idProduk = $stok->id_produk;
                $stokKeluarProduk = $stokKeluar->where('id_produk', $idProduk)->first();

                $stokProduk = ($stok->total_qty_a - ($stokKeluarProduk ? $stokKeluarProduk->total_qty_b : 0));

                $latestBeli = DB::table('bursa_stok_produk')
                    ->where('id_produk', $idProduk)
                    ->max('id');

                $latestJual = DB::table('bursa_stok_produk')
                    ->where('id_produk', $idProduk)
                    ->max('id');

                $hargaBeli = DB::table('bursa_stok_produk')
                    ->where('id', $latestBeli)
                    ->value('beli');

                $hargaJual = DB::table('bursa_stok_produk')
                    ->where('id', $latestJual)
                    ->value('jual');

                DB::table('bursa_produks')
                    ->where('id', $idProduk)
                    ->update([
                        'stok' => $stokProduk,
                        'harga_beli' => $hargaBeli,
                        'harga_jual' => $hargaJual,
                    ]);
            }

            DB::commit();
            AlertHelper::deleteAlert(true);
            return back();
        } catch (\Throwable $err) {
            DB::rollBack();
            AlertHelper::deleteAlert(false);
            return back();
        }
    }
}
