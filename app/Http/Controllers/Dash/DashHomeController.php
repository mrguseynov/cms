<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashHomeController extends Controller
{
    public function index()
    {
        return view('dash.index');
    }
}
