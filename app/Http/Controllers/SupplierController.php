<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\SupplierModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class SupplierController extends Controller
{
    protected $title = 'faeyza farma';
    protected $menu = 'Master Data';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Supplier',
            'label' => 'List supplier',
        ];
        return view('supplier.index')->with($data);
    }

    public function data_list(Request $request)
    {
        $userdata = DB::table('supplier')
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
            'submenu' => 'Input supplier',
            'label' => 'Input supplier',
        ];
        return view('supplier.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {

            for ($i = 0; $i < count($request->dataTabel); $i++) {
                $produk = new SupplierModel();
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Edit supplier',
            'label' => 'Edit supplier',
            'editsuplier' => SupplierModel::findOrfail($id)
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
            $produk = SupplierModel::findOrFail($id);
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
            $hapus = SupplierModel::findOrFail($id);
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
