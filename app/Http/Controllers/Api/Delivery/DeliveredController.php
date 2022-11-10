<?php

namespace App\Http\Controllers\Api\Delivery;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DeliveredItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DeliveredController extends Controller
{
    //handles delivery

    //add a delivery
    public function addDelivery(Request $request){
        
        //validate user entry
        $validator = Validator::make($request->all(), [
            'plate_id' =>  'required',
            'user_id' => 'required',
            'company_id' => 'required',
            'quantity' => 'required',
            'cost' => 'required',
        ]);

        //if validation fails
        if($validator->fails()){
            return $validator->messages();
        }else{

            //add delivery
            $delivery = DeliveredItem::create($request->all());

            //if success, return success message else error message
            if($delivery){
                return response()->json(['delivery' => $delivery,'response_code'=>'200','message'=>'Delivery added']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
            }
        }
    }

    //change delivery status
    public function changeDeliveryStatus(Request $request){

        //add date delivered
        $request['date'] = Carbon::now();

        //change status to delivered
        $request['delivered'] = 1;

        $deliveryStatus = DeliveredItem::find($request->id)->update($request->all());

        //if creation is a success return return success
        if($deliveryStatus){
            return response()->json(['Delivery Status' => $deliveryStatus,'response_code'=>'200','message'=>'Plate(s) delivered']);
        }else{
            return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
        }
    }

    //get all deliveries
    public function getAllDeliveries(){
        //get all deliveries
        $statement = DB::raw("select d.id,p.number_plate,CONCAT(u.fname,' ',u.mname,' ',u.lname) as sent_by,d.delivered,d.date,c.name,d.quantity,d.cost from delivered_items d,plates p,users u,companies c where d.plate_id = p.id and d.user_id = u.id and d.company_id = c.id");
        $deliveredItems = DB::select($statement);
        
        return response()->json(['all deliveries' => $deliveredItems,'response_code'=>'200','message'=>'All deliveries']);
    }
    
}


