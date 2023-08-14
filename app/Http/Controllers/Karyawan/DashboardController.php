<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Karyawan | Dashboard';
        $page  = 'dashboard';

        return view('Karyawan.dashboard',compact('title','page'));
    }
}
