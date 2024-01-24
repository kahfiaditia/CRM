<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\JenisModel;
use App\Models\ObatModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ObatController extends Controller
{
    protected $title = 'Obat';
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
        return view('obat.index')->with($data);
    }

    public function data_list(Request $request)
    {
        $userdata = DB::table('obat')
            ->whereNull('deleted_at');
        // ->get();
        // dd($userdata);
        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $userdata->where(function ($where) use ($search) {
                $where
                    ->orWhere('obat', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%')
                    ->orWhere('stok_minimal', 'like', '%' . $search . '%')
                    ->orWhere('jenis_id', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });

            $search = $request->get('search');
            // $search_rak = str_replace(' ', '', $search);
            if ($search != null) {
                $userdata->where(function ($where) use ($search) {
                    $where
                        ->orWhere('obat', 'like', '%' . $search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $search . '%')
                        ->orWhere('stok_minimal', 'like', '%' . $search . '%')
                        ->orWhere('jenis_id', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            }
        } else {
            if ($request->get('obat') != null) {
                $obat = $request->get('obat');
                $userdata->where('obat', '=', $obat);
            }
            if ($request->get('deskripsi') != null) {
                $deskripsi = $request->get('deskripsi');
                $userdata->where('deskripsi', '=', $deskripsi);
            }
            if ($request->get('stok_minimal') != null) {
                $stok_minimal = $request->get('stok_minimal');
                $userdata->where('stok_minimal', '=', $stok_minimal);
            }
            if ($request->get('jenis_id') != null) {
                $jenis_id = $request->get('jenis_id');
                $userdata->where('jenis_id', '=', $jenis_id);
            }
            if ($request->get('status') != null) {
                $status = $request->get('status');
                $userdata->where('status', '=', $status);
            }
        }

        return DataTables::of($userdata)
            ->addColumn('action', 'obat.akse')
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
            'submenu' => 'Obat',
            'label' => 'Input Obat',
            'satuan' => JenisModel::all()
        ];
        return view('obat.create')->with($data);
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
                $produk = new ObatModel();
                $produk->obat =  $request->dataTabel[$i]['obat'];
                $produk->jenis_id =  $request->dataTabel[$i]['jenis'];
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
    public function show(string $id)
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
            'editsuplier' => ObatModel::findOrfail($id)
        ];
        return view('obat.edit')->with($data);
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
            $produk = ObatModel::findOrFail($id);
            $produk->supplier = $request->supplier;
            $produk->alamat = $request->alamat;
            $produk->kontak = $request->kontak;
            $produk->telp = $request->telp;
            $produk->status = $request->status1;
            $produk->user_updated = Auth::user()->id;
            $produk->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/obat');
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
            $hapus = ObatModel::findOrFail($id);
            $hapus->deleted_at = Carbon::now();
            $hapus->user_deleted = Auth::user()->id;
            $hapus->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/obat');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }
}
