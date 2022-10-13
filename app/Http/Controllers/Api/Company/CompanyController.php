<?php

namespace App\Http\Controllers\Api\Company;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    //add new company
    public function addCompany(Request $request){

        //validate user entry
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'location' => 'required',
            'phone' => 'required|unique:companies',
            'email' => 'unique:companies|required',
        ]);

        //if the validator fails output the error message else create user
        if($validator->fails()){
            return $validator->messages();
        }else{
            //now create the company
            $company = Company::create($request->all());
            return response()->json(['company' => $company,'response_code'=>'200','message'=>'Company Added']);
        }

        
    }
}
