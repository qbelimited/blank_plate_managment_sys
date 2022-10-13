<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\UserPasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    //reset your password
    public function resetPassword(Request $request){
        //get the user id
        $user = User::where('email',$request->email) -> first();

        if($user){
             $user->password = bcrypt($request->password);
            $ok = $user->save();

            if($ok){
                //message to be sent to the user
                $details = [
                        'title' => 'Dear ' . $user->fname.' '.$user->lname,
                        'body' => 'Your password for number plate management system has changed. Contact the administrator for your new password to login',
                        'url' => env("APP_URL") . '/login'
                    ];

                Mail::to($user->email)->send(new UserPasswordReset($details));

                return response()->json(['response_code'=>'200','message'=>'password changed successfully']);
            }
        }else{
            return response()->json(['response_code'=>'401','message'=>'Incorrect email or user does not exist']);
        }
       

    }
}
