<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * manage the various logins for the various users
     *
     */
    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->type == 'embosser') {
                return redirect()->route('emb.home')->with('successMsg', 'Successfully logged-in');
            } else if (auth()->user()->type == 'manufacturer') {
                return redirect()->route('man.home')->with('successMsg', 'Successfully logged-in');
            } else if (auth()->user()->type == 'dvla') {
                return redirect()->route('dvla.home')->with('successMsg', 'Successfully logged-in');
            } else {
                return redirect()->route('home')->with('successMsg', 'Successfully logged-in');
            }
        } else {
            return redirect()->route('login')
                ->with('errorMsg', 'Email-Address And Password Are Wrong.');
        }
    }
}
