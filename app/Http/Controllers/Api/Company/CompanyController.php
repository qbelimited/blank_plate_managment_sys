<?php

namespace App\Http\Controllers\Api\Company;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Helper\RolesCheck;

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

                //if creation is a success return return success
                if($company){
                    return response()->json(['company' => $company,'response_code'=>'200','message'=>'Company Added']);
                }else{
                    return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
                }
                
            }
       

        

        
    }

    //update company details
    public function updateCompany(Request $request){

            //validate user entry
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'location' => 'required',
                'status' => 'required',
                'phone' => [
                    'required',
                    Rule::unique('companies')->ignore($request->id),
                ],
                'email' => [
                    'required',
                    Rule::unique('companies')->ignore($request->id),
                ],
            ]);

            //if the validator fails output the error message else create user
            if($validator->fails()){
                return $validator->messages();
            }else{
                $company = Company::find($request->id)->update($request->all());
                //if creation is a success return return success
                if($company){
                    return response()->json(['company' => $company,'response_code'=>'200','message'=>'Company Updated']);
                }else{
                    return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
                }
            }

        
    }


    //get all companies
    public function getCompanies(){
        //get all companies
        return response()->json(['company' => Company::all(),'response_code'=>'200','message'=>'Company Updated']);
    }

    //deactivate company
    public function deactivateCompany(Request $request){
        $company = Company::find($request->id);
        $company->status = 0;
        $ok = $company->save();
        if($ok){
            return response()->json(['company' => $company,'response_code'=>'200','message'=>'Company Deactivated']);
        }
    }

    //activate company
    public function activateCompany(Request $request){
        $company = Company::find($request->id);
        $company->status = 1;
        $ok = $company->save();
        if($ok){
            return response()->json(['company' => $company,'response_code'=>'200','message'=>'Company Activated']);
        }
    }
}
