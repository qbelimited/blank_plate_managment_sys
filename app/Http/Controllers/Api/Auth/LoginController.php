<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    //this function handles all logins from the api
    public function login(Request $request){

        //validate the credential passed by the user
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //try to authenticate the user 
        //if the auth is successfull return the access token else return error
        if(Auth::attempt($login)){
            // $token = Auth::user()->createToken('AuthToken')->accessToken;
            $token ="lkjfjdlkjfld";

            if (auth()->user()->hasRole('Embosser')) {
                return response()->json(['user' => Auth::user(), 'token' => $token, 'response_code'=>'200','message'=>'redirect to embosser screen']);
            } else if (auth()->user()->hasRole('Manufacturer')) {
                return response()->json(['user' => Auth::user(), 'token' => $token, 'response_code'=>'200','message'=>'redirect to manufacturer screen']);
            } else if (auth()->user()->hasRole('Dvla')) {
                return response()->json(['user' => Auth::user(), 'token' => $token, 'response_code'=>'200','message'=>'redirect to dvla screen']);
            } else {
                return response()->json(['user' => Auth::user(), 'token' => $token, 'response_code'=>'200','message'=>'redirect to super admin']);
            }
        }else{
            return response()->json(['error' => 'Unauthorised user','response_code'=>'401']);
        }

            
        
    }
}
