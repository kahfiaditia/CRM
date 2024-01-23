<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\JenisModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class JenisController extends Controller
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
            'submenu' => 'Jenis Obat',
            'label' => 'List Jenis Obat',
            'list' => JenisModel::all()
        ];
        return view('jenis.index')->with($data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Jenis',
            'label' => 'Input Jenis',
        ];
        return view('jenis.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'jenis' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $produk = new JenisModel();
            $produk->jenis =  $request->jenis;
            $produk->deskripsi =  $request->jenis;
            $produk->status =  1;
            $produk->user_created = Auth::user()->id;
            $produk->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/jenis');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
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
        // dd($id)
        $id_decrypt = Crypt::decryptString($id);
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Edit supplier',
            'label' => 'Edit supplier',
            'editjenis' => JenisModel::findOrfail($id_decrypt)
        ];
        return view('jenis.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required',
            'descr' => 'required',
            'status1' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $produk = JenisModel::findOrFail($id);
            $produk->jenis = $request->jenis;
            $produk->deskripsi = $request->descr;
            $produk->status = $request->status1;
            $produk->user_updated = Auth::user()->id;
            $produk->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/jenis');
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
        DB::beginTransaction();
        try {
            $hapus = JenisModel::findOrFail($id_decrypt);
            $hapus->deleted_at = Carbon::now();
            $hapus->user_deleted = Auth::user()->id;
            $hapus->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/jenis');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }
}
