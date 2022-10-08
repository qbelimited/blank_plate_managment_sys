<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    //reset your password
    public function resetPassword(Request $request){
        //get the user id
        $user = User::find($request->id);
        $user->password = $request->password;
        $user->save();
    }
}
