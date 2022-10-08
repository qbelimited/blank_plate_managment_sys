<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\UserCreationMail;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //Register function to take care of user registration from api
    public function register(Request $request){

        //validate user creation details
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'email' => 'required|email',
            'national_id' => 'unique:users|required',
            'role_id' => 'required',
        ]);

        //if the validator fails output the error message else create user
        if($validator->fails()){
            $error_msg = $validator->messages();
            return response()->json(['response_code'=>'401','message'=>'user details validation failed'.$error_msg]);
        }else{

            //get all request
            $input = $request->all();

            
            // generate a random password for the user
            $randomPassword = Str::random(10);
            //decrypt the password
            $input['password'] = bcrypt($randomPassword);

            //now create the user
            $user = User::create($input);

            //assign role to user
            // $admin = Role::create(['name' => 'Admin3']);
            $role = Role::find($request->role_id);
            $user->assignRole([$role]);

            //message to be sent to the user
            $details = [
                    'title' => 'Dear ' . $user->fname.' '.$user->lname,
                    'body' => 'An active account has been created for you. Use your email and  your secret password ' . $randomPassword . ' to login',
                    'url' => env("APP_URL") . '/login'
                ];

            Mail::to($request['email'])->send(new UserCreationMail($details));

            return response()->json(['response_code'=>'200','message'=>'user created successfully']);
        }
    }
}
