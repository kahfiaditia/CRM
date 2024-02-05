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
    protected $menu = 'Master Data';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'List User',
            'label' => 'Users',
            'dataku' => User::whereNull('deleted_at')->get()
        ];
        return view('user.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Tambah User',
            'label' => 'Users',
            'dataku' => User::all()
        ];
        return view('user.tambah')->with($data);
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
            $produk->email = $request->email;
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
        $id_decryprt = Crypt::decryptString($id);
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Edit User',
            'label' => 'Users',
            'dataku' => User::findOrFail($id_decryprt)
        ];
        return view('user.edit')->with($data);
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
    }
}
