<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $title = 'List User';
    protected $menu = 'User';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $dataquery = User::where('roles', '!=', 'Customer')
            ->whereNull('deleted_at')
            ->get();

        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('5', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'List User',
                'label' => 'Users',
                'dataku' => $dataquery
            ];
            return view('user.index')->with($data);
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
        if (in_array('6', $session_menu)) {
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Tambah User',
                'label' => 'Users',
                'dataku' => User::all()
            ];
            return view('user.tambah')->with($data);
        } else {
            return view('not_found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $produk = new User();
            $produk->roles =  $request->roles;
            $produk->name =  $request->nama;
            $produk->username =  $request->username;
            $produk->email = $request->email;
            $produk->phone = $request->telepon;
            $produk->password = bcrypt($request->password);
            $produk->save();


            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/data_user');
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
        if (in_array('7', $session_menu)) {
            $id_decryprt = Crypt::decryptString($id);
            $data = [
                'title' => $this->title,
                'menu' => $this->menu,
                'submenu' => 'Edit User',
                'label' => 'Users',
                'dataku' => User::findOrFail($id_decryprt)
            ];
            return view('user.edit')->with($data);
        } else {
            return view('not_found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $user_update = User::findOrFail($id);
            $user_update->roles =  $request->roles;
            $user_update->name =  $request->nama;
            $user_update->email = $request->email;
            $user_update->phone = $request->telepon;
            $user_update->save();


            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/data_user');
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
        $session_menu = explode(',', Auth::user()->submenu);
        if (in_array('8', $session_menu)) {
            DB::beginTransaction();
            try {
                $id_decryprt = Crypt::decryptString($id);
                $hapus = User::findOrFail($id_decryprt);
                $hapus->deleted_at = Carbon::now();
                $hapus->save();

                DB::commit();
                AlertHelper::addAlert(true);
                return redirect('/data_user');
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

    public function profile($id)
    {
        $id_decrypted = Crypt::decryptString($id);
        $data = [
            'title' => $this->title,
            'submenu' => $this->menu,
            'label' => 'ubah akun',
            // 'school_level' => School_level::all(),
            'akun' => User::findorfail($id_decrypted)
        ];
        return view('akun.edit')->with($data);
    }
}
