<?php

namespace App\Http\Controllers\Api\Delivery;

use Carbon\Carbon;
use App\Models\ReceivedItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReceivedController extends Controller
{
    //handles received plates

    //confirm plate received plates
    public function confirmReceived(Request $request){

        //add date delivered
        $request['date_verified'] = Carbon::now();

        //change status to delivered
        $request['verified'] = 1;

        //verify received item
        $received = ReceivedItem::create($request->all());


        //if verification is a success return return success
        if($received){
            return response()->json(['Delivery Status' => $received,'response_code'=>'200','message'=>'Plate(s) received']);
        }else{
            return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
        }
    }

    //get all verified deliveries
    public function getVerifiedPlates(Request $request){
        //get all received plates
        return response()->json(['All received plates' => ReceivedItem::all(),'response_code'=>'200','message'=>'All received plates']);
    }
}
