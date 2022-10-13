<?php

namespace App\Http\Controllers\Helper;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesCheck{


    public static function instance()
     {
         return new RolesCheck();
     }

     //check for super admin user role
     public function checkAdmin(){
        return Auth::user()->hasRole('Admin');
     }
     
}
