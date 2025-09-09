<?php

namespace App\Http\Controllers\Supervisor;

use App\EmployeeDetails;
use App\Helper\Reply;
use App\Http\Requests\User\UpdateProfile;
use App\Notifications\NewUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
class SupervisorProfileController extends SupervisorBaseController
{
    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('app.menu.profileSettings');
        $this->pageIcon = 'icon-user';
    }


    public function password(){
        return view('supervisor.dashboard.password', $this->data);
    }
    public function ChangePassword( Request $request){
        // dd($request->all());
        //dd('here');
        $user=Auth::user();
        //$user=findorfail($id);
        $user = User::find(Auth::id());
        $this->validate($request,[
            'old_password' => 'required',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|same:password'
        ]);


        $hashedPassword=$user->password;
        //dd($hashedPassword);
        $password=$request->old_password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            //Change the password

            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
            //$user->passrec=0;
            $user->save();
        }
        else{
            return back()
                ->with('message','The specified password does not match the database password');
        }
        // Alert::success('Password Changed Successfuly', 'Changed!');
        return redirect()->route('supervisor.dashboard');
    }
    public function updatePassword(){

        return view('supervisor.dashboard.updatepassword', $this->data);
    }
    public function profile(){
        $user=Auth::user();
//        dd($user);
        return view('supervisor.dashboard.profile', $this->data, compact('user'));
    }
    public function updateBasic(Request $request){
//        $user=User::find(Auth::user()->id);
        $user=Auth::user();
        $user->update(['name'=>$request->name, 'admission_staff_no'=>$request->admission_staff_no, 'gender'=>$request->gender]);
        return back();
    }
    public function updateContact(Request $request){
        $user=Auth::user();
        $user->update(['phone'=>$request->phone, 'email'=>$request->email]);

        return back();
    }
    public function updatephoto(Request $request){
        if(Auth::user()->image==null){
            $user=Auth::user();
            // dd(Auth::user());

            $image=$request->image;
            $imagename=$image->getClientOriginalName();
            $mime=$image->getClientMimeType();
            $user->image=$imagename;
            $user->mime=$mime;

            $image->move('profile', $imagename);
            $user->save();
            return back();

        }
        else{
            $filename=Auth::user()->image;
            $path = public_path().'/profile/'.$filename;
            //dd($path);
            unlink($path);
            $user=Auth::user();
            // dd(Auth::user());

            $image=$request->image;
            $imagename=$image->getClientOriginalName();
            $mime=$image->getClientMimeType();
            $user->image=$imagename;
            $user->mime=$mime;

            $image->move('profile', $imagename);

            $user->save();
            // dd('deleted');
            return back();


        }

    }
    public function firstlogin(Request $request){
        //dd('here');
        $user = User::find(Auth::id());
        // dd($user);
        $this->validate($request,[
            'password'=>'required|min:4',
            'password_confirmation'=>'required|same:password'
        ]);


        $hashedPassword=$user->password;
        //Change the password

        $user->fill([
            'password' => Hash::make($request->password)
        ])->save();
        $user->passrec=1;
        $user->save();
        $user->notify(new NewUser($user));
        return redirect()->route('supervisor.dashboard');
    }
}
