<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

class ZtaController
{
    public function index()
    {
        return view('dashboard.index', ['content' => 'zta.index']);
    }

    public function log(Request $request)
    {

    }
}
