<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
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
            'password' => 'required',
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

            //decrypt the password
            $input['password'] = bcrypt($input['password']);

            //now create the user
            $user = User::create($input);

            //assign role to user
            // $admin = Role::create(['name' => 'Admin3']);
            $role = Role::find($request->role_id);
            $user->assignRole([$role]);
            return response()->json(['response_code'=>'200','message'=>'user created successfully']);
        }
    }
}
