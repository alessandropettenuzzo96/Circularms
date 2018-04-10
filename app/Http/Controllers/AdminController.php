<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends NavigationController
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
    public function index()
    {
        return view('theme.index');
    }

    public function settings() {
        return view('admin.settings');
    }
}
