<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }

    /**
     * Display a listing of the activities.
     *
     * @return \Illuminate\Http\Response
     */
    public function activities()
    {
        return view('admin.dashboard.activities');
    }
}
