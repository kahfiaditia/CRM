<?php

namespace App\Http\Controllers;

use App\Exports\DownloadedHasil;
use App\Models\PenangananModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class HasilLaporanController extends Controller
{
    protected $title = 'Penanganan';
    protected $menu = 'Laporan';
    /**
     * Display a listing of the resource.
     */

    public function cari_data_penanganan(Request $request)
    {
        // dd($request->all());
        $userdata = DB::table('pelaporan')
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
                'penanganan.kode_penanganan',
                'penanganan.updated_at',
                'penanganan.hasil_progres'
            )
            ->leftJoin('penanganan', 'penanganan.id_pelaporan', '=', 'pelaporan.id')
            ->leftJoin('pelanggan', 'pelaporan.id_customer', '=', 'pelanggan.id')
            ->leftJoin('aplikasi', 'pelaporan.id_aplikasi', '=', 'aplikasi.id');

        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            $replaced = str_replace(' ', '', $search);
            $userdata->where(function ($where) use ($search, $replaced) {
                $where
                    ->orWhere('kode', 'like', '%' . $search . '%')
                    ->orWhere('customer', 'like', '%' . $search . '%')
                    ->orWhere('aplikasi.nama', 'like', '%' . $search . '%')
                    ->orWhere('hasil_progres', 'like', '%' . $search . '%')
                    ->orWhere('updated_at', 'like', '%' . $search . '%');
            });
        } else {
            if ($request->get('kode') != null) {
                $kode = $request->get('kode');
                $userdata->where('kode', '=', $kode);
            }
            if ($request->get('customer') != null) {
                $customer = $request->get('customer');
                $userdata->where('customer', 'LIKE', '%' . $customer . '%');
            }
            if ($request->get('aplikasi') != null) {
                $aplikasi = $request->get('aplikasi');
                $userdata->where('aplikasi.nama', 'LIKE', '%' . $aplikasi . '%');
            }
            if ($request->get('status2') != null) {
                $status2 = $request->get('status2');
                $userdata->where('hasil_progres', 'LIKE', '%' . $status2 . '%');
            }
            if ($request->get('tgl_end') != null) {
                $start = $request->get('tgl_start');
                $end = $request->get('tgl_end');
                $userdata->whereBetween(DB::raw('DATE_FORMAT(penanganan.updated_at, "%Y-%m-%d %H:%i:%s")'), [$start . ' 00:00:00', $end . ' 23:59:59']);
            }

            return DataTables::of($userdata)
                ->addColumn('action', 'laporan_penanganan.button')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function index()
    {

        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('25', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => $this->title,
                'label' => 'Laporan',
            ];
            return view('laporan_penanganan.index')->with($data);
        } else {
            return view('not_found');
        }
    }

    public function export_laporan(Request $request)
    {

        // dd($request->all());
        $data = [
            'kode' => $request->kode,
            'customer' => $request->customer,
            'aplikasi' => $request->aplikasi,
            'status2' => $request->status2,
            'tgl_start' => $request->tgl_start,
            'tgl_end' => $request->tgl_end,
            'search_manual' => $request->search_manual,
            'like' => $request->like,
        ];
        return Excel::download(new DownloadedHasil($data), 'data_list_laporan' . date('YmdH') . '.xlsx');
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
