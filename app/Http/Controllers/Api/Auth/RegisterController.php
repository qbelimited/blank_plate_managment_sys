<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\UserCreationMail;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{


    //Register function to take care of user registration from api
    public function register(Request $request){

        //check for permission
        if(!Auth::user()->hasRole('Admin')){
            return response()->json(['response_code'=>'401','message'=>'user does not have permission to create users']);
        }

        //validate user creation details
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'national_id' => 'unique:users|required',
            'role_id' => 'required',
            'company_id' => 'required',
        ]);

        //if the validator fails output the error message else create user
        if($validator->fails()){
            return $validator->messages();
        }else{

            //get all request
            $input = $request->all();

            
            // generate a random password for the user
            // $randomPassword = Str::random(10);

            //decrypt the password
            $input['password'] = bcrypt($request->password);

            //now create the user
            $user = User::create($input);

            //assign role to user
            $role = Role::find($request->role_id);
            $user->assignRole([$role]);

            //message to be sent to the user
            $details = [
                    'title' => 'Dear ' . $user->fname.' '.$user->lname,
                    'body' => 'An active number plate management system account has been created for you. Contact the administrator for your credentials to login',
                    'url' => env("APP_URL") . '/login'
                ];

            Mail::to($request['email'])->send(new UserCreationMail($details));

            return response()->json(['response_code'=>'200','message'=>'user created successfully']);
        }
    }

    
}
