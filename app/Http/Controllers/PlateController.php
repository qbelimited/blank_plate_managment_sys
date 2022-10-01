<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Plate;
use App\Models\PlateDimension;
use App\Models\PlateColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PlateController extends Controller
{
    public function allPlate(Request $request)
    {
        $platecolors = PlateColor::all();
        $platedims = PlateDimension::all();
        $id = Auth::user()->company_id;
        $company = Company::find($id);

        if ($request->ajax()) {
            $data = Plate::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('plate', compact('platecolors', 'platedims', 'company'));
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
