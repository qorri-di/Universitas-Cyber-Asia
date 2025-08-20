<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

class UserController
{
    public function index()
    {
        return view('dashboard.index', ['content' => 'user.index']);
    }
}
