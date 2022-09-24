<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard
     * for super Admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard
     * for manufacturer.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manHome()
    {
        return view('manuf.Home');
    }

    /**
     * Show the application dashboard
     * for DVLA.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dvlaHome()
    {
        return view('dvla.Home');
    }

    /**
     * Show the application dashboard
     * for embossers.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function embHome()
    {
        return view('emboss.Home');
    }
}
