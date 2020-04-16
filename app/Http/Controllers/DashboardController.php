<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        return view('theme.dashboard');
    }
}
