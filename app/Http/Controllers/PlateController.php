<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Plate;
use App\Models\Company;
use App\Models\PlateColor;
use App\Models\Production;
use Illuminate\Http\Request;
use App\Models\PlateDimension;
use App\Models\Productionweek;
use App\Models\Productionyear;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PlateController extends Controller
{

    public function allPlate()
    {
        $plates = Plate::all();
        $Platecolors = PlateColor::all();
        $platedims = PlateDimension::all();
        $id = Auth::user()->company_id;
        $company = Company::find($id);

        return view('plate', compact('plates', 'Platecolors', 'platedims', 'company'));
    }

    public function editPlate($id)
    {
        $plate = Plate::find($id);

        return view('home', compact('plate'));
    }

    // public function viewPlate($id)
    // {
    //     $plate = Plate::find($id);

    //     return view('home', compact('plate'));
    // }

    // public function searchPlate($id)
    // {
    //     $plate = Plate::find($id);

    //     return view('home', compact('plate'));
    // }
}
