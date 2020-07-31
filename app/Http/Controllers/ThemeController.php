<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ThemeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('dashboard.theme.starter');
    }

    public function dashboard_v1()
    {
        return view('dashboard.theme.home');
    }

    public function dashboard_v2()
    {
        return view('dashboard.theme.home_v2');
    }

    public function chartjs()
    {
        return view('dashboard.theme.pages.charts.chartjs');
    }

    public function widgets()
    {
        return view('dashboard.theme.pages.widgets');
    }
}
