<?php

namespace App\Http\Controllers\Api\Help;

use Illuminate\Http\Request;
use App\Models\Helpandsupport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HelpAndSupportController extends Controller
{
    //handles all help and support activities

    //adds a help request from user
    public function askForHelp(Request $request){

        //validate user entry
        $validator = Validator::make($request->all(), [
            'priority' => 'required',
            'subject' =>  'required',
            'message' => 'required'
        ]);

        //if the validation fails return error, else save data
        if($validator->fails()){
            return $validator->messages();
        }else{
            
            //now add the help
            $help = Helpandsupport::create($request->all());

            //if success, return success message else error message
            if($help){
                return response()->json(['Help' => $help,'response_code'=>'200','message'=>'Message sent']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
            }
        }
    }

    //get all help request
    public function getAllHelpRequest(){
        //get all help and support requests
        return response()->json(['Help and support' => Helpandsupport::all(),'response_code'=>'200','message'=>'All Help']);
    }
}
