<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Area;
use Auth;

class SupervisorController extends SupervisorBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('Students');
        $this->pageIcon = 'icon-people';
    }

    public function index(){
        return view('supervisor.home');
    }
    public function password(){
        return view('supervisor.password');
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
        return redirect()->route('supervisor.index');
    }
    public function updatePassword(){

        return view('supervisor.updatepassword');
    }
    public function firstlogin(Request $request){
        //dd($request->all());
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
        return redirect()->route('supervisor.index');
    }
    public function profile(){
        $user=Auth::user();
//        dd($user);
        return view('supervisor.profile', compact('user'));
    }
    public function updateBasic(Request $request){
//        $user=User::find(Auth::user()->id);
        $user=Auth::user();
        $user->update(['name'=>$request->name, 'id_number'=>$request->id_no, 'gender'=>$request->gender]);
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
    public function viewStudents(){
        $supervisor=Auth::user()->supervisor;
        $students=$supervisor->students;
        return view('supervisor.students.view', $this->data, compact(['students']));
    }

    public function studentProfile($id){
        $student=User::find($id);
        return view('supervisor.students.profile', $this->data, compact(['student']));
    }
    public function supervisionarea(){
        $user=Auth::user();
        $areas=$user->areas;
        return view('supervisor.supervisionarea', $this->data,compact('areas'));
    }
    public function saveArea(Request $request){
        $id=Auth::user()->id;
        $area=new Area();
        $area->user_id=$id;
        $area->supervision_area=$request->supervision_area;
        $area->save();
        return back();

    }
}
