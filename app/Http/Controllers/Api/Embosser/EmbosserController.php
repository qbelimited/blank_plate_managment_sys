<?php

namespace App\Http\Controllers\Api\Embosser;

use App\Models\Embosser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmbosserController extends Controller
{
    //Handles all embosser actions
    
    //Emboss number plate
    public function embossPlate(Request $request){

       //validate user entry
        $validator = Validator::make($request->all(), [
            // 'plate_id' => 'required|unique:embossers',
            'embosser_color_id' =>  'required',
            'embosser_text' => 'required',
            'status' => 'required|integer'
        ]); 


        //if the validation fails return error
        if($validator->fails()){
            return $validator->messages();
        }else{

            //get the number plate details{commented untill number plate is ready}

            // $numberPlate = Plate::find($id);
            // $request['serial_number_id'] = $production_week_id->id;

            // $request['serial_number_id'] = 1;

            //now emboss the plate
            $embosser = Embosser::create($request->all());

            //if success, return success message else error message
            if($embosser){
                return response()->json(['embosser' => $embosser,'response_code'=>'200','message'=>'Embossed successfully']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
            }
            
        }
    }

    //get all embossed plates
    public function getAllEmbossed(){
        
        //select all embossed plates and their details
        $statement = DB::raw("SELECT e.id,p.number_plate,e.embosser_text,m.color,e.status FROM `embossers` e,plates p,embosser_colors m where e.plate_id = p.id and m.id = e.embosser_color_id");
        $embossed = DB::select($statement);

        //get all embossed plates
        return response()->json(['embossed plates' => $embossed,'response_code'=>'200','message'=>'All embossed plates']);
    }

    //add edit embossed plate
    public function updateEmbossedPlate(Request $request){


        //validate user entry
        $validator = Validator::make($request->all(), [
                // 'plate_id' => [
                //     'required',
                //     Rule::unique('embossers')->ignore($request->id),
                // ],
                'embosser_color_id' =>  'required',
                'embosser_text' => 'required',
                'status' => 'required|integer'

        ]);
                

        //if the validation fails return error
        if($validator->fails()){
                return $validator->messages();
        }else{
                
                //now update the embossed plate
                $embossedPlate = Embosser::find($request->id)->update($request->all());

                //if update is a success return return success
                if($embossedPlate){
                    return response()->json(['response_code'=>'200','message'=>'Update successfull']);
                }else{
                    return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
                }
        }
    }
}
