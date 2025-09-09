<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use UxWeb\SweetAlert\SweetAlert;
use Alert;
use UxWeb\SweetAlert\ConvertMessagesIntoSweetAlert;
use UxWeb\SweetAlert\SweetAlert;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function emailForm(){
        $setting = Setting::first();
        return view('auth.passwords.email', compact(['setting']));
    }
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }
    protected function sendResetLinkFailedResponse(Request $request, $response)    {


        return back()->withErrors(
            ['email' => trans($response)]
        );

    }
    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }

}
