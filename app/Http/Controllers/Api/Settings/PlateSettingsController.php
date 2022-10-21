<?php

namespace App\Http\Controllers\Api\Settings;

use App\Models\Embosser;
use App\Models\Platecolor;
use Illuminate\Http\Request;
use App\Models\EmbosserColor;
use App\Models\Platedimension;
use App\Models\Productionweek;
use App\Models\Productionyear;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PlateSettingsController extends Controller
{
    //handles the number plate settings

    /**
     * PLATE COLOR SETTINGS
     */

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


    /**
     * PLATE EMBOSSER COLOR SETTINGS
     */

    //add color
    public function addEmbosserColor(Request $request){
        
           //validate user entry
            $validator = Validator::make($request->all(), [
                'color' => 'required|unique:embosser_colors',
                'code' => 'required|unique:embosser_colors',
            ]);

             //if the validation fails return error
        if($validator->fails()){
            return $validator->messages();
        }else{
            
                //now create the embosser color
                $embosserColor = EmbosserColor::create($request->all());

                //if creation is a success return return success
                if($embosserColor){
                    return response()->json(['embosser color' => $embosserColor,'response_code'=>'200','message'=>'Embosser Color Added']);
                }else{
                    return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
                }
        }
    }

    //add edit color
    public function updateEmbosserColor(Request $request){
        
        //validate user entry
        $validator = Validator::make($request->all(), [
                'color' => [
                    'required',
                    Rule::unique('embosser_colors')->ignore($request->id),
                ],
                'code' => [
                    'required',
                    Rule::unique('embosser_colors')->ignore($request->id),
                ],
        ]);
                

        //if the validation fails return error
        if($validator->fails()){
                return $validator->messages();
        }else{
                
                //now update the embosser color
                $embosserColor = EmbosserColor::find($request->id)->update($request->all());

                //if update is a success return return success
                if($embosserColor){
                    return response()->json(['response_code'=>'200','message'=>'Embosser Color Updated']);
                }else{
                    return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
                }
        }
    }

    //get all the embosser colors
    public function getEmbosserColors(){
        //get all embosser colors
        return response()->json(['embosser colors' => EmbosserColor::all(),'response_code'=>'200','message'=>'All embosser colors']);
    }

    //deactivate plate color
    public function deactivateEmbosserColor(Request $request){
        $embosserColor = EmbosserColor::find($request->id);
        $embosserColor->status = 0;
        $ok = $embosserColor->save();
        if($ok){
            return response()->json(['embosser color' => $embosserColor,'response_code'=>'200','message'=>'Embosser Color Deactivated']);
        }
    }

    //activate embosser color
    public function activateEmbosserColor(Request $request){
        $embosserColor = EmbosserColor::find($request->id);
        $embosserColor->status = 1;
        $ok = $embosserColor->save();
        if($ok){
            return response()->json(['embosser color' => $embosserColor,'response_code'=>'200','message'=>'Embosser Color Activated']);
        }
    }



    /**
     * DIMENSION SETTINGS
     */

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

    //add update plate dimension
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

    //get all the plate dimensions
    public function getPlateDimensions(){
        //get all plate dimensions
        return response()->json(['platedimensions' => PlateDimension::all(),'response_code'=>'200','message'=>'All plate dimensions']);
    }

    //deactivate plate dimension
    public function deactivatePlateDimension(Request $request){
        $plateDimension = PlateDimension::find($request->id);
        $plateDimension->status = 0;
        $ok = $plateDimension->save();
        if($ok){
            return response()->json(['plate dimensions' => $plateDimension,'response_code'=>'200','message'=>'Plate Dimension Deactivated']);
        }
    }

    //activate plate dimension
    public function activatePlateDimension(Request $request){
        $plateDimension = PlateDimension::find($request->id);
        $plateDimension->status = 1;
        $ok = $plateDimension->save();
        if($ok){
            return response()->json(['plate dimensions' => $plateDimension,'response_code'=>'200','message'=>'Plate Dimension Activated']);
        }
    }



    /**
     * PRODUCTION WEEK SETTINGS
     */


      //add production week
    public function addProductionWeek(Request $request){
        
           //validate user entry
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'code' => 'required|unique:production_weeks',
            'status'=> 'required'
        ]);

             //if the validation fails return error
        if($validator->fails()){
            return $validator->messages();
        }else{
            
            //now create the production week
            $productionWeek = Productionweek::create($request->all());

            //if creation is a success return return success
            if($productionWeek){
                return response()->json(['production week' => $productionWeek,'response_code'=>'200','message'=>'Production Week Added']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
            }
        }
    }

    //add update production week
    public function updateProductionWeek(Request $request){
        
        //validate user entry
        $validator = Validator::make($request->all(), [                
                'code' => [
                    'required',
                    Rule::unique('production_weeks')->ignore($request->id),
                ],
                'description' => 'required',
                'status'=> 'required'
        ]);
                

        //if the validation fails return error
        if($validator->fails()){
                return $validator->messages();
        }else{
                
                //now update the production week
                $productionWeek = Productionweek::find($request->id)->update($request->all());

                //if creation is a success return return success
                if($productionWeek){
                    return response()->json(['response_code'=>'200','message'=>'Production Week Updated']);
                }else{
                    return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
                }
        }
    }

    //get all the production weeks
    public function getProductionWeeks(){
        //get all production weeks
        return response()->json(['production weeks' => Productionweek::all(),'response_code'=>'200','message'=>'All production weeks']);
    }

    //deactivate production week
    public function deactivateProductionWeek(Request $request){
        $productionWeek = Productionweek::find($request->id);
        if($productionWeek){
            $productionWeek->status = 0;
            $ok = $productionWeek->save();
            if($ok){
                return response()->json(['Production week' => $productionWeek,'response_code'=>'200','message'=>'Production week Deactivated']);
            }
        }else{
                return response()->json(['Production week' => $productionWeek,'response_code'=>'401','message'=>'Production week does not exist']);
        }
        
    }

    //activate production week
    public function activateProductionWeek(Request $request){
        $productionWeek = Productionweek::find($request->id);
        $productionWeek->status = 1;
        $ok = $productionWeek->save();
        if($ok){
            return response()->json(['production week' => $productionWeek,'response_code'=>'200','message'=>'Production week Activated']);
        }
    }



    /**
     * PRODUCTION YEAR SETTINGS
     */

      //add production year
    public function addProductionYear(Request $request){

           //validate user entry
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'code' => 'required|unique:production_years',
            'status'=> 'required'
        ]);

             //if the validation fails return error
        if($validator->fails()){
            return $validator->messages();
        }else{
            
            //now create the production year
            $productionYear = Productionyear::create($request->all());

            //if creation is a success return return success
            if($productionYear){
                return response()->json(['production year' => $productionYear,'response_code'=>'200','message'=>'Production Year Added']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
            }
        }
    }

    //add update production week
    public function updateProductionYear(Request $request){
        
        //validate user entry
        $validator = Validator::make($request->all(), [                
                'code' => [
                    'required',
                    Rule::unique('production_years')->ignore($request->id),
                ],
                'description' => 'required',
                'status'=> 'required'
        ]);
                

        //if the validation fails return error
        if($validator->fails()){
                return $validator->messages();
        }else{
                
                //now update the production year
                $productionYear = Productionyear::find($request->id)->update($request->all());

                //if creation is a success return return success
                if($productionYear){
                    return response()->json(['response_code'=>'200','message'=>'Production Week Updated']);
                }else{
                    return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
                }
        }
    }

    //get all the production years
    public function getProductionYears(){
        //get all production years
        return response()->json(['production years' => Productionyear::all(),'response_code'=>'200','message'=>'All production years']);
    }

    //deactivate production year
    public function deactivateProductionYear(Request $request){
        $productionYear = Productionyear::find($request->id);
        if($productionYear){
            $productionYear->status = 0;
            $ok = $productionYear->save();
            if($ok){
                return response()->json(['Production year' => $productionYear,'response_code'=>'200','message'=>'Production year Deactivated']);
            }
        }else{
                return response()->json(['Production year' => $productionYear,'response_code'=>'401','message'=>'Production year does not exist']);
        }
        
    }

    //activate production year
    public function activateProductionYear(Request $request){
        $productionYear = Productionyear::find($request->id);
        $productionYear->status = 1;
        $ok = $productionYear->save();
        if($ok){
            return response()->json(['production year' => $productionYear,'response_code'=>'200','message'=>'Production year Activated']);
        }
    }

}
