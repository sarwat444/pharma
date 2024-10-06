<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        return view('admins.dashboard.index');
    }


}
