<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\DB;

class DashboardController
{
    //
    public function index()
    {
        return view('dashboard.index', [
            'content' => 'home.index',
            'chartApi' => DB::table('vw_chart_api')->get(),
            'chartEdr' => DB::table('vw_chart_edr')->get(),
            'chartZta' => DB::table('vw_chart_zta')->get()
        ]);
    }
}
