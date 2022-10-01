<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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
            $token = Auth::user()->createToken('AuthToken')->accessToken;
            return response()->json(['user' => Auth::user(), 'token' => $token], 200);
        }else{
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
