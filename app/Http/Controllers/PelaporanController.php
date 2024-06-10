<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\AplikasiModel;
use App\Models\PelangganModel;
use App\Models\PelaporanModel;
use App\Models\RelationModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Str;
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
                'submenu' => 'Pelaporan',
                'label' => 'List Pelaporan',
                'pelaporandata' => PelaporanModel::all(),
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
        $email = Auth::user()->email;
        $nama = Auth::user()->name;
        $id_customer = Auth::user()->id;
        $cari = PelangganModel::where('email', $email)->first();
        $aplikasi = AplikasiModel::all();
        // dd($aplikasi);
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('5', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Input Pelaporan',
                'label' => 'Input Pelaporan',
                'customer' => $cari,
                'aplikasi' => $aplikasi,
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
        $request->validate([
            'screenshoot' => 'nullable|string|max:64',
            'id_customer' => 'nullable|exists:pelanggan,id',
            'id_aplikasi' => 'nullable|exists:aplikasi,id',
            'progres' => 'nullable|string|max:15',
            'deskripsi' => 'nullable|string|max:128',
            'link' => 'nullable|string|max:256',
        ]);

        $today = Carbon::now();
        $dateCode = $today->format('d'); // 2 digit tanggal
        $monthCode = $today->format('m'); // 2 digit bulan
        $sequence = PelaporanModel::whereDate('created_at', $today->toDateString())->count() + 1;
        $sequenceCode = str_pad($sequence, 2, '0', STR_PAD_LEFT); // 2 digit nomor urut

        $kodePelaporan = 'AT' . $dateCode . $monthCode . $sequenceCode;

        $session_menu = explode(',', Auth::user()->submenu);
        DB::beginTransaction();
        try {
            $pelaporan = new PelaporanModel();
            $pelaporan->kode = $kodePelaporan;
            $pelaporan->id_ar = $request->ar;
            $pelaporan->id_customer = $request->id_customer;
            $pelaporan->id_aplikasi = $request->id_aplikasi;
            $pelaporan->progres = "Terkirim";
            $pelaporan->deskripsi = $request->deskripsi;
            $pelaporan->link = $request->link;
            $pelaporan->user_created = auth()->user()->id;
            if ($request->hasFile('foto')) {
                $fileName = Carbon::now()->format('ymdhis') . '_' . Str::random(25) . '.' . $request->foto->extension();
                $pelaporan->screenshoot = $fileName;
                $request->foto->move(public_path('assets/pelaporan'), $fileName);
            }
            $pelaporan->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/pelaporan');
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
