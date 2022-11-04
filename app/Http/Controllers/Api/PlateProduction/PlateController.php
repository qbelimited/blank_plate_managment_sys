<?php

namespace App\Http\Controllers\Api\PlateProduction;

use Carbon\Carbon;
use App\Models\Plate;
use App\Models\Production;
use Illuminate\Http\Request;
use App\Models\Productionweek;
use App\Models\Productionyear;
use Illuminate\Support\Facades\DB;
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
        $statement = DB::raw("select p.id,c.color,d.description as dimension,p.batch_code,p.quantity,p.job_status,p.serial_starts,w.description as production_week,y.description as production_year,p.manufacture_date,p.status from productions p,plate_colors c,plate_dimensions d, production_weeks w,production_years y where c.id = p.plate_color_id and d.id = p.plate_dimension_id and w.id = p.production_week_id and y.id = p.production_year_id");
        $allProduction = DB::select($statement);
        
        return response()->json(['all productions' => $allProduction,'response_code'=>'200','message'=>'All productions']);
    }


    //get all number plates
    public function getNumbrPlates(){

        //get all the plates
        $statement = DB::raw("SELECT p.id,p.number_plate,s.serial,c.color,d.description as dimension,p.storage,w.name as warehouse from plates p,plate_colors c, plate_dimensions d, warehouses w,serial_numbers s where p.plate_color_id = c.id and p.plate_dimension_id = d.id and p.warehouse_id = w.id and p.serial_number_id = s.id");
        $allPlates = DB::select($statement);
        
        return response()->json(['all number plates' => $allPlates,'response_code'=>'200','message'=>'All number plates']);
    }

    //get plate
    public function getPlate(Request $request){
        // return search;
        $statement = DB::raw("SELECT p.id,p.number_plate,s.serial,c.color,d.description as dimension,p.storage,
         w.name as warehouse from plates p,plate_colors c, plate_dimensions d, warehouses w,serial_numbers s
         where p.plate_color_id = c.id and p.plate_dimension_id = d.id and p.warehouse_id = w.id and
         p.serial_number_id = s.id and number_plate LIKE '%$request->name%' and plate_color_id like '%$request->color%' and plate_dimension_id like '%$request->dimension%';");
        $plateSearch = DB::select($statement);
        
        // $plate = Plate::where([['number_plate','like','%'.$request->name.'%'],['plate_color_id','like','%'.$request->color.'%'],['plate_dimension_id','like','%'.$request->dimension.'%']])->get();

        if(count($plateSearch)>0){
            return response()->json(['Number plate(s)' => $plateSearch,'response_code'=>'200','message'=>'Number plates']);
        }else{
            return response()->json(['response_code'=>'200','message'=>'No data found']);
        }
    }
}
