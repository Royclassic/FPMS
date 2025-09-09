<?php

namespace App\Http\Controllers\Student;

use App\Issue;
use App\Notifications\NewUser;
use App\User;
use Hash;
use Auth;
use App\ProjectActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StudentDashboardController extends StudentBaseController
{

    public function __construct() {
        parent::__construct();
        $this->pageTitle = __("app.menu.dashboard");
        $this->pageIcon = 'icon-speedometer';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('student.dashboard.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function updatePassword(){

        return view('student.dashboard.updatepassword');
    }
    public function firstLogin(Request $request){
   // dd($request->all());
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
        return redirect()->route('student.dashboard.index');
    }
   public function supervisor()
    {
      $supervisor=Auth::user()->student->supervisor->user;
      return view('student.dashboard.supervisor', $this->data, compact(['supervisor']));
    }
}
