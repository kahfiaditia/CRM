<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\PelangganModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PelangganController extends Controller
{
    protected $title = 'Pelanggan';
    protected $menu = 'Master Data';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Pelanggan',
            'label' => 'List Pelanggan',
            'indexpelanggan' => PelangganModel::all(),
        ];
        return view('pelanggan.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Input pelanggan',
            'label' => 'Input pelanggan',
        ];
        return view('pelanggan.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {

            for ($i = 0; $i < count($request->dataTabel); $i++) {
                $produk = new PelangganModel();
                $produk->supplier =  $request->dataTabel[$i]['nama'];
                $produk->alamat =  $request->dataTabel[$i]['alamat'];
                $produk->kontak =  $request->dataTabel[$i]['kontak'];
                $produk->telp =  $request->dataTabel[$i]['telp'];
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
            'submenu' => 'Edit pelanggan',
            'label' => 'Edit pelanggan',
            'editsuplier' => PelangganModel::findOrfail($id)
        ];
        return view('pelanggan.edit')->with($data);
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
            $produk = PelangganModel::findOrFail($id);
            $produk->supplier = $request->supplier;
            $produk->alamat = $request->alamat;
            $produk->kontak = $request->kontak;
            $produk->telp = $request->telp;
            $produk->status = $request->status1;
            $produk->user_updated = Auth::user()->id;
            $produk->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/pelanggan');
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
            $hapus = PelangganModel::findOrFail($id);
            $hapus->deleted_at = Carbon::now();
            $hapus->user_deleted = Auth::user()->id;
            $hapus->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/pelanggan');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }
}
