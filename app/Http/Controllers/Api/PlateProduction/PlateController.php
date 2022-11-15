<?php

namespace App\Http\Controllers\Api\PlateProduction;

use Carbon\Carbon;
use App\Models\Plate;
use App\Models\Platecolor;
use App\Models\Production;
use Illuminate\Http\Request;
use App\Models\Platedimension;
use App\Models\Productionweek;
use App\Models\Productionyear;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PlateController extends Controller
{

    //this function handles batch production of plates
    public function addPlateProductionBatch(Request $request){

        //check the production table to see if serial_start already exist or is less than existing ones
        $statement = DB::raw("SELECT * FROM `productions` where '$request->serial_starts' <= productions.serial_starts;");
        $serialStartCheck = DB::select($statement);

        //if it exist or less than existing serial_starts prrevent user from proceeding
        if($serialStartCheck){
            return response()->json(['response_code'=>'401','message'=>'Last Serial has been used already or is lesser than existing ones']);
        }

        
        //validate user entry
        $validator = Validator::make($request->all(), [
            'plate_color_id' => 'required',
            'plate_dimension_id' =>  'required',
            'batch_code' => 'required|integer|unique:productions',
            'quantity' => 'required|integer',
            'serial_starts' => 'required|integer|unique:productions'
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

            //this function generates serial numbers for the number plates
            $this->generate_serial($plateBatch->id);

            // if success, return success message else error message
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


    //generate serial numbers for number plate
    public function generate_serial($id){

        //select the production batch to generate serials
        $statement = DB::raw("select * from productions where id = '$id' and job_status = 0");
        $plateB = DB::select($statement);

        //select production id,serial_starts,quantity
        $gen_id = $plateB[0]->id;
        $last_serial = $plateB[0]->serial_starts;
        $quantity = $plateB[0]->quantity;

        //get the start and end for generating
        $start = $last_serial+1;
        $end = $start + $quantity;

        //get the range
        $numbers = range($start, $end, 1);

        //generate serial numbers and insert into serials table
        foreach ($numbers as $number) {
            DB::table('serial_numbers')->insert(
                array(
                    'production_id'   =>   $gen_id,
                    'serial'   =>   $number,
                )
            );
        }

        //call the generate plate function
        $this->generatePlate($gen_id);

    }


    //generate plates from serial
    public function generatePlate($gen_id){

        //get the production details
        $statement = DB::raw("select * from productions where id = '$gen_id'");
        $productionDetails = DB::select($statement);

        //get the serials
        $statement = DB::raw("select * from serial_numbers where production_id = '$gen_id'");
        $allSerials = DB::select($statement);

        //get the id's of all related data
        $plateColorId = $productionDetails[0]->plate_color_id;
        $plateDimensionId = $productionDetails[0]->plate_dimension_id;
        $batchCode = $productionDetails[0]->batch_code;
        $lastSerial = $productionDetails[0]->serial_starts;
        $productionWeekId = $productionDetails[0]->production_week_id;
        $productionYearId = $productionDetails[0]->production_year_id;

        //get the codes of each related data
        $plateColorCode = Platecolor::find($plateColorId,'code');
        $plateDimensionCode = Platedimension::find($plateDimensionId, 'code');
        $plateWeekCode = Productionweek::find($productionWeekId,'code');
        $plateYearCode = Productionweek::find($productionYearId,'code');

        //generate the plates 
        foreach ($allSerials as $serial) {
            DB::table('plates')->insert(
                array(
                    'number_plate'   =>   $plateDimensionCode->code."".$plateColorCode->code."".$batchCode."".$serial->serial."".$plateWeekCode->code."".$plateYearCode->code,
                    'plate_color_id'   =>   $plateColorId,
                    'plate_dimension_id'   =>   $plateDimensionId,
                    'serial_number_id' => $serial->id,

                )
            );

            //update serial to set assigned to 1
            $statement = DB::raw("update serial_numbers set assigned = 1 where id = '$serial->id'");
            DB::update($statement);
        }

    }
}
