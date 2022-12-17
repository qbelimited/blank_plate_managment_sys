<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Mail\UserActivation;
use Illuminate\Http\Request;
use App\Mail\UserDeactivation;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //update user function
    public function updateUser(Request $request){



        //validate user entry
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'national_id' => [
                'required',
                Rule::unique('users')->ignore($request->id),
            ],
            'role_id' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($request->id),
            ],
        ]);

        //if the validation fails return error
        if($validator->fails()){
            return $validator->messages();
        }else{

            //get the user 
            $user = User::find($request->id);

            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->national_id = $request->national_id;
            $user->company_id = $request->company_id;

            $ok = $user->save();

            //assign role to user
            $role = Role::find($request->role_id);
            $user->syncRoles($role);

            if($ok){
                return response()->json(['response_code'=>'200','message'=>'user updated successfully']);
            }

        }


        

    }

   
    //this function gets all users and their roles
    public function getUsers(){

        return response()->json(['users' => User::with('roles')->paginate(15),'response_code'=>'200','message'=>'All users']);
    }

    //deactivate user
    public function deactivate(Request $id){
        //get the user and set status to 0 {0,inactive}
        $user = User::find($id->id);
        $user->status = 0;
        $ok = $user->save();

        //if success then return success message
        if($ok){

            //message to be sent to the user
            $details = [
                'title' => 'Dear ' . $user->fname.' '.$user->lname,
                'body' => 'Your account for number plate management system has been deactivated. Contact the administrator for more details',
                'url' => env("APP_URL") . '/login'
            ];

           Mail::to($user->email)->send(new UserDeactivation($details));

           return response()->json(['response_code'=>'200','message'=>'User deactivated']); 
        }else{
            return response()->json(['response_code'=>'400','message'=>'An issue occurred, user not deactivated']); 
        }

        
    }

    //activate user
    public function activate(Request $id){

        //get the user and set status to 0 {0,inactive}
        $user = User::find($id->id);
        $user->status = 1;
        $ok = $user->save();

        //if success then return success message
        if($ok){

            //message to be sent to the user
            $details = [
                'title' => 'Dear ' . $user->fname.' '.$user->lname,
                'body' => 'Your account for number plate management system has been activated. Contact the administrator for more details',
                'url' => env("APP_URL") . '/login'
            ];

           Mail::to($user->email)->send(new UserActivation($details));

           return response()->json(['response_code'=>'200','message'=>'User Activated']); 
        }else{
            return response()->json(['response_code'=>'400','message'=>'An issue occurred, user not deactivated']); 
        }

        
    }

    //get the details of a single user
    public function getUser(Request $request){

        //get the user and return 
        $user = User::where('id', $request->id)->with('roles','company')->first();
        if($user){
            return response()->json(['users' => $user,'response_code'=>'200','message'=>'User details']);
        }else{
            return response()->json(['response_code'=>'401','message'=>'User does not exist']);
        }

    }

    //get all roles
    public function getUserRoles(){
        return $roles = Role::all();
    }

}
