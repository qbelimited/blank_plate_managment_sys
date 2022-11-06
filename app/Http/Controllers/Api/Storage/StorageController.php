<?php

namespace App\Http\Controllers\Api\Storage;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StorageController extends Controller
{
    //handles warehouse


    //adds new warehouse
    public function addWareHouse(Request $request){

        //validate user entry
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        //if the validation fails return error, else save data
        if($validator->fails()){
            return $validator->messages();
        }else{
            
            //now create the warehouse
            $warehouse = Warehouse::create($request->all());

            //if success, return success message else error message
            if($warehouse){
                return response()->json(['Warehouse' => $warehouse,'response_code'=>'200','message'=>'Warehouse created']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
            }
        }
    }

    //get warehouse and the number plates in storage
    public function getWareHouseItems(Request $request){

        //get all number plates
        // $warehouse = Warehouse::find($request->id)->plates;

        $statement = DB::raw("SELECT p.number_plate,c.color,d.description as dimension,p.storage,w.name as warehouse from plates p,plate_colors c, plate_dimensions d, warehouses w where p.plate_color_id = c.id and p.plate_dimension_id = d.id and p.warehouse_id = w.id and warehouse_id = '$request->id';");
        $warehouseItems = DB::select($statement);
        

        if($warehouseItems){
            return response()->json(['all warehouse items' => $warehouseItems,'response_code'=>'200','message'=>'All warehouse items']);
        }else{
            return response()->json(['response_code'=>'200','Warehouse Empty'=>$warehouseItems]);
        }
    }

     //get warehouse and the number plates in storage
    public function getWareHouses(Request $request){

        //get all number plates
        $warehouses = Warehouse::all();

        if($warehouses){
            return response()->json(['all warehouses' => $warehouses,'response_code'=>'200','message'=>'All warehouses']);
        }else{
            return response()->json(['response_code'=>'400','message'=>'Something went wrong']);
        }
    }
}
