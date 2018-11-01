<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function home()
    {
        return view('pages.home');
    }
}
