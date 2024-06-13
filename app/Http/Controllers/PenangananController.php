<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\PelangganModel;
use App\Models\PelaporanModel;
use App\Models\PenangananModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PenangananController extends Controller
{
    protected $title = 'Penanganan Client';
    protected $menu = 'Penanganan';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelaporanData = DB::table('pelaporan')
            ->leftJoin('penanganan', 'penanganan.id_pelaporan', '=', 'pelaporan.id')
            ->leftJoin('pelanggan', 'pelaporan.id_customer', '=', 'pelanggan.id')
            ->leftJoin('aplikasi', 'pelaporan.id_aplikasi', '=', 'aplikasi.id')
            ->select(
                'pelaporan.id as lapor_id',
                'pelaporan.kode',
                'pelaporan.screenshoot',
                'pelaporan.deskripsi',
                'pelaporan.created_at',
                'pelaporan.progres',
                'pelaporan.id_aplikasi',
                'aplikasi.nama as aplikasi',
                'pelaporan.id_customer',
                'pelanggan.nama as customer',
                'penanganan.id as tangani_id',
                'penanganan.kode_penanganan'
            )
            ->get();

        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('21', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Pelaporan',
                'label' => 'List Pelaporan',
                'tangani' => $pelaporanData,
            ];
            return view('penanganan.index')->with($data);
        } else {
            return view('not_found');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        // dd($id);
        $editprogress = DB::table('pelaporan')
            ->leftJoin('penanganan', 'penanganan.id_pelaporan', '=', 'pelaporan.id')
            ->leftJoin('pelanggan', 'pelaporan.id_customer', '=', 'pelanggan.id')
            ->leftJoin('aplikasi', 'pelaporan.id_aplikasi', '=', 'aplikasi.id')
            ->where('penanganan.id', $id)
            ->select(
                'pelaporan.id as lapor_id',
                'pelaporan.kode',
                'pelaporan.screenshoot',
                'pelaporan.link',
                'pelaporan.deskripsi',
                'pelaporan.created_at',
                'pelaporan.progres',
                'pelaporan.id_aplikasi',
                'aplikasi.nama as aplikasi',
                'pelaporan.id_customer',
                'pelanggan.nama as customer',
                'penanganan.id as tangani_id',
                'penanganan.kode_penanganan'
            )
            ->get();

        // $id_decrypt = Crypt::decryptString($id);
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('23', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Penanganan',
                'label' => 'Eksekusi Penanganan',
                'eksekusi' => PenangananModel::findOrFail($id),
                'edit' =>  $editprogress
            ];

            return view('penanganan.edit')->with($data);
        } else {
            return view('not_found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        // $id_decrypt = Crypt::decryptString($id);
        // dd($id_decrypt);
        // $session_menu = explode(',', Auth::user()->submenu);
        // if (in_array('22', $session_menu)) {
        DB::beginTransaction();
        try {
            $pelaporan = PenangananModel::findOrfail($id);
            // dd($pelaporan);
            $pelaporan->hasil_progres = $request->status2;
            $pelaporan->user_created = Auth::user()->id;
            $pelaporan->save();

            $test = PenangananModel::findOrfail($id);
            $update = PelaporanModel::findOrfail($test->id_pelaporan);
            $update->progres = $request->status2;
            $update->user_created = Auth::user()->id;
            $update->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/penanganan');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
        // } else {
        //     return view('not_found');
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
