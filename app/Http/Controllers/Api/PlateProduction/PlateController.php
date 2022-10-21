<?php

namespace App\Http\Controllers\Api\PlateProduction;

use Carbon\Carbon;
use App\Models\Plate;
use App\Models\Production;
use Illuminate\Http\Request;
use App\Models\Productionweek;
use App\Models\Productionyear;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PlateController extends Controller
{

    //this function handles batch production of plates
    public function addPlateProductionBatch(Request $request){
        
        //validate user entry
        $validator = Validator::make($request->all(), [
            'plate_color_id' => 'required',
            'plate_dimension_id' =>  'required',
            'batch_code' => 'required|integer|unique:productions',
            'quantity' => 'required|integer',
            'serial_starts' => 'required|integer'
        ]);

        //if the validation fails return error
        if($validator->fails()){
            return $validator->messages();
        }else{

            //get the current week and current year and use it to get corresponding id in the database
            $production_week_id = Productionweek::where('description','like','%'.date("W").'%')->first();
            $production_year_id = Productionyear::where('description','like','%'.date("Y").'%')->first();

            //add the production week and year id to the request
            $request['production_week_id'] = $production_week_id->id;
            $request['production_year_id'] = $production_year_id->id;

            //get the current date and time and add it to the request
            $request['manufacture_date'] = Carbon::now()->toDateTimeString();

            //now create the plate batch
            $plateBatch = Production::create($request->all());

            //if success, return success message else error message
            if($plateBatch){
                return response()->json(['plate batch' => $plateBatch,'response_code'=>'200','message'=>'Batch created successfully']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
            }
        }

    }

    //get all the production years
    public function getAllProduction(){
        //get all production years
        return response()->json(['production years' => Production::all(),'response_code'=>'200','message'=>'All production']);
    }


    //get all number plates
    public function getNumbrPlates(){
        return response()->json(['all number plates' => Plate::all(),'response_code'=>'200','message'=>'All number plates']);
    }

    //get plate
    public function getPlate(Request $request){
        // return $request;
        $plate = Plate::where([['number_plate','like','%'.$request->name.'%'],['plate_color_id','like','%'.$request->color.'%'],['plate_dimension_id','like','%'.$request->dimension.'%']])->get();

        if(count($plate)>0){
            return response()->json(['Number plate(s)' => $plate,'response_code'=>'200','message'=>'Number plates']);
        }else{
            return response()->json(['response_code'=>'200','message'=>'No data found']);
        }
    }
}
