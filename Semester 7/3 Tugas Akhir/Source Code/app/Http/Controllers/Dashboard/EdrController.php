<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

class EdrController
{
    public function index()
    {
        return view('dashboard.index', ['content' => 'edr.index']);
    }

    public function log(Request $request)
    {

    }
}
