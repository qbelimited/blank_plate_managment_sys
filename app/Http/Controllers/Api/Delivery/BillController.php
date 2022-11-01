<?php

namespace App\Http\Controllers\Api\Delivery;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\ReceivedItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    //handles bills

    //make payment
    public function makePayment(Request $request){

        //validate user entry
        $validator = Validator::make($request->all(), [
            'received_item_id' =>  'required',
            'currency_id' => 'required',
            'paid_by' => 'required',
            'method_of_payment' => 'required'
        ]);


        //if validation fails
        if($validator->fails()){
            return $validator->messages();
        }else{

            //date paid
            $request['paid_at'] = Carbon::now();

            //set paid to true
            $request['ispaid'] = 1;

            //make payment
            $bill = Bill::create($request->all());

            //if success, return success message else error message
            if($bill){
                return response()->json(['bill' => $bill,'response_code'=>'200','message'=>'Payment made']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
            }
        }
    }

    //confirm payment
    public function confirmPayment(Request $request){
        //find the bill
        $bill = Bill::find($request->id);

        //confirm the payment
        $bill->isconfirmed = 1;

        //save the confirmation
        $confirmed = $bill->save();

        //if success, return success message else error message
        if($confirmed){
            return response()->json(['payment confirmed' => $confirmed,'response_code'=>'200','message'=>'Payment confirmed']);
        }else{
            return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
        }
    }

    //get all payments
    public function getAllBills(){
        //get all bills     
        return response()->json(['All Bills' => Bill::all(),'response_code'=>'200','message'=>'All bills']);
    }


    //this function get the number plates that were paid for by passing the id of the bill
    public function getBillDetails(Request $request){
         return response()->json(['Bill Details' => Bill::find($request->id)->ReceivedItem->DeliveredItem,'response_code'=>'200','message'=>'Bill Details']);
    }

    // return Bill::find(2)->ReceivedItem;
        // return ReceivedItem::find(1)->Bill;
}
