<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Setting;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        $setting = Setting::first();
        return view('auth.login', compact('setting'));
    }

    public function username()
    {
        return 'admission_staff_no';
    }

    protected function redirectTo()
    {
        $user = auth()->user();
        if ($user->hasRole('coordinator')) {
            return 'coordinator/dashboard';
        } elseif ($user->hasRole('supervisor')) {
            return 'supervisor/dashboard';
        } elseif ($user->hasRole('student')) {
            return 'student/dashboard';
        }


    }
//    protected function authenticated(Request $request, $user)
//
//    {
//        if($user->status==0){
//            return $this->deactivated($request);
//        }
//    }
//    public function deactivated(Request $request)
//    {
//
//        $this->guard()->logout();
//
//        $request->session()->invalidate();
//
//        return redirect()->route('login')->with('deactivated', 'Your account has been deactivated, Please contact the Administrator for solution');
//    }
}
