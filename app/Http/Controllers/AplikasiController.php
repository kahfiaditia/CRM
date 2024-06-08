<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\AplikasiModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AplikasiController extends Controller
{
    protected $title = 'Aplikasi';
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
                'submenu' => 'Aplikasi',
                'label' => 'List Aplikasi',
                'aplikasi' => AplikasiModel::all()
            ];
            return view('aplikasi.index')->with($data);
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
                    ->orWhere('status', 'like', '%' . $search . '%');
            });

            $search = $request->get('search');
            // $search_rak = str_replace(' ', '', $search);
            if ($search != null) {
                $userdata->where(function ($where) use ($search) {
                    $where
                        ->orWhere('nama', 'like', '%' . $search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $search . '%')
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
            if ($request->get('status') != null) {
                $status = $request->get('status');
                $userdata->where('status', '=', $status);
            }
        }

        return DataTables::of($userdata)
            ->addColumn('action', 'aplikasi.akse')
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
                'submenu' => 'Aplikasi',
                'label' => 'Input Aplikasi',
            ];
            return view('aplikasi.create')->with($data);
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
                $produk = new AplikasiModel();
                $produk->nama =  $request->dataTabel[$i]['produk'];
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
                'submenu' => 'View aplikasi',
                'label' => 'View aplikasi',
                'viewobat' => AplikasiModel::findOrfail($id)
            ];
            return view('aplikasi.show')->with($data);
        } else {
            return view('not_found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id_decrypt = Crypt::decryptString($id);
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('15', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Edit aplikasi',
                'label' => 'Edit aplikasi',
                'editaplikasi' => AplikasiModel::findOrfail($id_decrypt),
            ];
            return view('aplikasi.edit')->with($data);
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
            'nama' => 'required',
            'deskripsi' => 'required',
            'status1' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $editobat = AplikasiModel::findOrFail($id);
            $editobat->nama = $request->nama;
            $editobat->deskripsi = $request->deskripsi;
            $editobat->status = $request->status1;
            $editobat->user_updated = Auth::user()->id;
            $editobat->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/aplikasi');
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
         $id_decrypt = Crypt::decryptString($id);
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('16', $session_menu)) {
            DB::beginTransaction();
            try {
                $hapus = AplikasiModel::findOrFail($id_decrypt);
                $hapus->deleted_at = Carbon::now();
                $hapus->user_deleted = Auth::user()->id;
                $hapus->save();

                DB::commit();
                AlertHelper::addAlert(true);
                return redirect('/aplikasi');
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
