<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\ProdukModel;
use App\Models\SatuanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    protected $title = 'Produk';
    protected $menu = 'Master Data';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('13', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Produk',
                'label' => 'List Produk',
            ];
            return view('produk.index')->with($data);
        } else {
            return view('not_found');
        }
    }

    public function data_list(Request $request)
    {
        $userdata = DB::table('produk')
            ->select('produk.id', 'produk.nama', 'produk.deskripsi','harga_beli', 'harga_jual', 'stok', 'produk.status', 'satuan.nama as satuan')
            ->leftJoin('satuan', 'produk.satuan_id', '=', 'satuan.id')
            ->whereNull('produk.deleted_at');

        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $userdata->where(function ($where) use ($search) {
                $where
                    ->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%')
                    ->orWhere('stok_minimal', 'like', '%' . $search . '%')
                    ->orWhere('satuan', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });

            $search = $request->get('search');
            // $search_rak = str_replace(' ', '', $search);
            if ($search != null) {
                $userdata->where(function ($where) use ($search) {
                    $where
                        ->orWhere('nama', 'like', '%' . $search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $search . '%')
                        ->orWhere('stok_minimal', 'like', '%' . $search . '%')
                        ->orWhere('satuan', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            }
        } else {
            if ($request->get('nama') != null) {
                $nama = $request->get('nama');
                $userdata->where('nama', '=', $nama);
            }
            if ($request->get('deskripsi') != null) {
                $deskripsi = $request->get('deskripsi');
                $userdata->where('deskripsi', '=', $deskripsi);
            }
            if ($request->get('stok_minimal') != null) {
                $stok_minimal = $request->get('stok_minimal');
                $userdata->where('stok_minimal', '=', $stok_minimal);
            }
            if ($request->get('satuan_id') != null) {
                $jenis_id = $request->get('satuan_id');
                $userdata->where('satuan', '=', $jenis_id);
            }
            if ($request->get('status') != null) {
                $status = $request->get('status');
                $userdata->where('status', '=', $status);
            }
        }

        return DataTables::of($userdata)
            ->addColumn('action', 'produk.akse')
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('14', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Produk',
                'label' => 'Input Produk',
                'satuan' => SatuanModel::all()
            ];
            return view('produk.create')->with($data);
        } else {
            return view('not_found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->dataTabel);
        DB::beginTransaction();
        try {

            for ($i = 0; $i < count($request->dataTabel); $i++) {
                $produk = new ProdukModel();
                $produk->nama =  $request->dataTabel[$i]['produk'];
                $produk->satuan_id =  $request->dataTabel[$i]['satuan'];
                $produk->stok_minimal =  $request->dataTabel[$i]['minimal'];
                $produk->deskripsi =  $request->dataTabel[$i]['deskripsi'];
                $produk->status =  1;
                $produk->user_created = Auth::user()->id;
                $produk->save();
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
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('13', $session_menu)) {

            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'View Produk',
                'label' => 'View Produk',
                'viewobat' => ProdukModel::findOrfail($id)
            ];
            return view('produk.show')->with($data);
        } else {
            return view('not_found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('15', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Edit produk',
                'label' => 'Edit produk',
                'editobat' => ProdukModel::findOrfail($id),
                'jenis' => SatuanModel::all()
            ];
            return view('produk.edit')->with($data);
        } else {
            return view('not_found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'produk' => 'required',
            'satuan' => 'required',
            'status1' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $editobat = ProdukModel::findOrFail($id);
            $editobat->nama = $request->produk;
            $editobat->deskripsi = $request->descr;
            $editobat->satuan_id = $request->satuan;
            $editobat->status = $request->status1;
            $editobat->user_updated = Auth::user()->id;
            $editobat->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/produk');
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
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('16', $session_menu)) {
            DB::beginTransaction();
            try {
                $hapus = ProdukModel::findOrFail($id);
                $hapus->deleted_at = Carbon::now();
                $hapus->user_deleted = Auth::user()->id;
                $hapus->save();

                DB::commit();
                AlertHelper::addAlert(true);
                return redirect('/produk');
            } catch (\Throwable $err) {
                DB::rollback();
                throw $err;
                AlertHelper::addAlert(false);
                return back();
            }
        } else {
            return view('not_found');
        }
    }
}
