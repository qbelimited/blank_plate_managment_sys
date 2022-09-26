<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $id = Auth::user()->company_id;
        $company = Company::find($id);

        return view('home', compact('company'));
    }

    /**
     * Show the application dashboard
     * for manufacturer.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manHome()
    {
        $id = Auth::user()->company_id;
        $company = Company::find($id);

        return view('manuf.Home', compact('company'));
    }

    /**
     * Show the application dashboard
     * for DVLA.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dvlaHome()
    {
        $id = Auth::user()->company_id;
        $company = Company::find($id);

        return view('dvla.Home', compact('company'));
    }

    /**
     * Show the application dashboard
     * for embossers.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function embHome()
    {
        $id = Auth::user()->company_id;
        $company = Company::find($id);

        return view('emboss.Home', compact('company'));
    }
}
