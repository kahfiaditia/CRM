<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\AplikasiModel;
use App\Models\PelangganModel;
use App\Models\RelationModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RelationController extends Controller
{
    protected $title = 'Relation';
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
                'submenu' => 'Relation',
                'label' => 'List Relation',
                 'relation' => RelationModel::all(),
            ];
            return view('relation.index')->with($data);
        } else {
            return view('not_found');
        }
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
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('14', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Input pembelian',
                'label' => 'Input pembelian',
                'customer' => PelangganModel::all(),
            ];
            return view('relation.input')->with($data);
        } else {
            return view('not_found');
        }
    }

    public function mengambil_data_customer(Request $request)
    {
        $customer = PelangganModel::all();
        return response()->json($customer);
    }

    public function mengambil_data_aplikasi(Request $request)
    {
        $aplikasi = AplikasiModel::all();
        return response()->json($aplikasi);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        // $session_menu = explode(',', Auth::user()->submenu);
        // if (in_array('22', $session_menu)) {
            DB::beginTransaction();
            try {
                
                foreach ($request->tableData as $data) {
                $relation = new RelationModel();
                $relation->id_customer = $data['customer_id'];
                $relation->id_aplikasi = $data['aplikasi_id'];
                $relation->status = 1;
                $relation->user_created = Auth::user()->id;
                $relation->save();
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
        // } else {
        //     return view('not_found');
        // }
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $session_menu = explode(',', Auth::user()->submenu);
    //     if (in_array('21', $session_menu)) {
    //         $pembeliancari = PembelianModel::where('id', $id)->first();
    //         $detilpembelian = PembelianDetilModel::where('pembelian_id', $pembeliancari->id)->get();
    //         $data = [
    //             'title' => $this->title,
    //             'menu' => $this->menu,
    //             'submenu' => 'View Pembelian',
    //             'label' => 'View Pembelian',
    //             'pembelian' => $pembeliancari,
    //             'detilpembelian' => $detilpembelian
    //         ];
    //         return view('pembelian.show')->with($data);
    //     } else {
    //         return view('not_found');
    //     }
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
    //     $session_menu = explode(',', Auth::user()->submenu);
    //     if (in_array('23', $session_menu)) {
    //         $pembeliancari = PembelianModel::where('id', $id)->first();
    //         $detilpembelian = PembelianDetilModel::where('pembelian_id', $pembeliancari->id)->get();
    //         $data = [
    //             'title' => $this->title,
    //             'menu' => $this->menu,
    //             'submenu' => 'Edit Pembelian',
    //             'label' => 'Edit Pembelian',
    //             'supplier' => SupplierModel::all(),
    //             'editpembelian' => PembelianModel::findOrfail($id),
    //             'detilpembelian' => $detilpembelian,
    //             'barang' => DB::table('obat')->select('*')->whereNull('deleted_at')->get(),
    //         ];
    //         return view('pembelian.edit')->with($data);
    //     } else {
    //         return view('not_found');
    //     }
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id_decrypt = Crypt::decryptString($id);
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('24', $session_menu)) {
            DB::beginTransaction();
            try {
                $delete = RelationModel::findorfail($id_decrypt);
                $delete->user_deleted = Auth::user()->id;
                $delete->deleted_at = Carbon::now();
                $delete->save();

                
                DB::commit();
                AlertHelper::deleteAlert(true);
                return back();
            } catch (\Throwable $err) {
                DB::rollBack();
                AlertHelper::deleteAlert(false);
                return back();
            }
        } else {
            return view('not_found');
        }
    }
}
