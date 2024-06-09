<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\PelaporanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PelaporanController extends Controller
{
    protected $title = 'Pelaporan';
    protected $menu = 'Pelaporan';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('17', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Customer',
                'label' => 'List Customer',
                'indexpelanggan' => PelaporanModel::all(),
            ];
            return view('pelaporan.index')->with($data);
        } else {
            return view('not_found');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('18', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Input Pelaporan',
                'label' => 'Input Pelaporan',
            ];
            return view('pelaporan.create')->with($data);
        } else {
            return view('not_found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('18', $session_menu)) {
            DB::beginTransaction();
            try {
                $produk = new PelaporanModel();
                $produk->nama =  $request->nama;
                $produk->alamat =  $request->alamat;
                $produk->telp =  $request->telp;
                $produk->status =  1;
                $produk->user_created = Auth::user()->id;
                $produk->save();

                DB::commit();
                AlertHelper::addAlert(true);
                return redirect('/pelaporan');
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
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('19', $session_menu)) {
            $id_decrypt = Crypt::decryptString($id);
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Edit Customer',
                'label' => 'Edit Customer',
                'editpelanggan' => PelaporanModel::findOrfail($id_decrypt)
            ];
            return view('pelanggan.edit')->with($data);
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
            'telp' => 'required',
        ]);

        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('18', $session_menu)) {
            DB::beginTransaction();
            try {
                $produk = PelaporanModel::findOrFail($id);
                $produk->nama = $request->nama;
                $produk->alamat = $request->alamat;
                $produk->telp = $request->telp;
                $produk->status = 1;
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
        } else {
            return view('not_found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('20', $session_menu)) {
            $id_decrypt = Crypt::decryptString($id);
            DB::beginTransaction();
            try {
                $hapus = PelaporanModel::findOrFail($id_decrypt);
                $hapus->deleted_at = Carbon::now();
                $hapus->user_deleted = Auth::user()->id;
                $hapus->save();

                DB::commit();
                AlertHelper::addAlert(true);
                return redirect('/pelaporan');
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
