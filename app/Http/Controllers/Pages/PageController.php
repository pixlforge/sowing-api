<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * PageController constructor.
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        return view('pages.home');
    }
}
