<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $title = 'Faeyza Farma';
    protected $menu = 'Dashboard';

    public function index()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Dashboard',
            'label' => 'Dashboard',
        ];
        return view('dashboard.index')->with($data);
    }
}
