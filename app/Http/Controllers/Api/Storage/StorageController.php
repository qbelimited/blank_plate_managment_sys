<?php

namespace App\Http\Controllers\Api\Storage;

use App\Models\Warehouse;
use Illuminate\Http\Request;
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
        $warehouse = Warehouse::find($request->id)->plates;

        if($warehouse){
            return response()->json(['all warehouse items' => $warehouse,'response_code'=>'200','message'=>'All warehouse items']);
        }else{
            return response()->json(['response_code'=>'400','message'=>'Something went wrong']);
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
