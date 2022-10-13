<?php

namespace App\Http\Controllers\Api\Settings;

use App\Models\Platecolor;
use Illuminate\Http\Request;
use App\Models\Platedimension;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PlateSettingsController extends Controller
{
    //handles the number plate settings

    //add color
    public function addPlateColor(Request $request){
        
           //validate user entry
            $validator = Validator::make($request->all(), [
                'color' => 'required|unique:plate_colors',
                'code' => 'required|unique:plate_colors',
            ]);

             //if the validation fails return error
        if($validator->fails()){
            return $validator->messages();
        }else{
            
                //now create the plate color
                $platecolor = Platecolor::create($request->all());

                //if creation is a success return return success
                if($platecolor){
                    return response()->json(['platecolor' => $platecolor,'response_code'=>'200','message'=>'Plate Color Added']);
                }else{
                    return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
                }
        }
    }

    //add edit color
    public function updatePlateColor(Request $request){
        
        //validate user entry
        $validator = Validator::make($request->all(), [
                'color' => [
                    'required',
                    Rule::unique('plate_colors')->ignore($request->id),
                ],
                'code' => [
                    'required',
                    Rule::unique('plate_colors')->ignore($request->id),
                ],
        ]);
                

        //if the validation fails return error
        if($validator->fails()){
                return $validator->messages();
        }else{
                
                //now update the plate color
                $platecolor = Platecolor::find($request->id)->update($request->all());

                //if creation is a success return return success
                if($platecolor){
                    return response()->json(['response_code'=>'200','message'=>'Plate Color Updated']);
                }else{
                    return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
                }
        }
    }

    //get all the plate colors
    public function getPlateColors(){
        //get all plate colors
        return response()->json(['platecolors' => PlateColor::all(),'response_code'=>'200','message'=>'All plate colors']);
    }

    //deactivate plate color
    public function deactivatePlateColor(Request $request){
        $platecolor = PlateColor::find($request->id);
        $platecolor->status = 0;
        $ok = $platecolor->save();
        if($ok){
            return response()->json(['plate color' => $platecolor,'response_code'=>'200','message'=>'Plate Color Deactivated']);
        }
    }

    //activate plate color
    public function activatePlateColor(Request $request){
        $platecolor = PlateColor::find($request->id);
        $platecolor->status = 1;
        $ok = $platecolor->save();
        if($ok){
            return response()->json(['plate color' => $platecolor,'response_code'=>'200','message'=>'Plate Color Activated']);
        }
    }



    //DIMENSION SETTINGS

    //add dimension
    public function addPlateDimension(Request $request){
        
           //validate user entry
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'code' => 'required|unique:plate_colors',
            'dimensions' => 'required|unique:plate_dimensions',
            'status'=> 'required'
        ]);

             //if the validation fails return error
        if($validator->fails()){
            return $validator->messages();
        }else{
            
            //now create the dimension
            $plateDimension = Platedimension::create($request->all());

            //if creation is a success return return success
            if($plateDimension){
                return response()->json(['platedimension' => $plateDimension,'response_code'=>'200','message'=>'Plate Dimension Added']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
            }
        }
    }

    //add edit color
    public function updatePlateDimension(Request $request){
        
        //validate user entry
        $validator = Validator::make($request->all(), [
                'dimensions' => [
                    'required',
                    Rule::unique('plate_dimensions')->ignore($request->id),
                ],
                'code' => [
                    'required',
                    Rule::unique('plate_dimensions')->ignore($request->id),
                ],
                'description' => 'required',
                'status'=> 'required'
        ]);
                

        //if the validation fails return error
        if($validator->fails()){
                return $validator->messages();
        }else{
                
                //now update the dimension
                $plateDimension = Platedimension::find($request->id)->update($request->all());

                //if creation is a success return return success
                if($plateDimension){
                    return response()->json(['response_code'=>'200','message'=>'Plate Dimension Updated']);
                }else{
                    return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
                }
        }
    }

    //get all the plate colors
    public function getPlateDimensions(){
        //get all companies
        return response()->json(['platedimensions' => PlateDimension::all(),'response_code'=>'200','message'=>'All plate dimensions']);
    }

    //deactivate plate color
    public function deactivatePlateDimension(Request $request){
        $plateDimension = PlateDimension::find($request->id);
        $plateDimension->status = 0;
        $ok = $plateDimension->save();
        if($ok){
            return response()->json(['plate dimensions' => $plateDimension,'response_code'=>'200','message'=>'Plate Dimension Deactivated']);
        }
    }

    //activate plate color
    public function activatePlateDimension(Request $request){
        $plateDimension = PlateDimension::find($request->id);
        $plateDimension->status = 1;
        $ok = $plateDimension->save();
        if($ok){
            return response()->json(['plate dimensions' => $plateDimension,'response_code'=>'200','message'=>'Plate Dimension Activated']);
        }
    }

}
