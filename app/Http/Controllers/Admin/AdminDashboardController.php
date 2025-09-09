<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use App\Helper\Reply;
use App\Issue;
use App\Project;
use App\ProjectActivity;
use App\Task;
use App\User;
use App\UserActivity;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use UxWeb\SweetAlert\SweetAlert;
use Auth;
use Hash;


class AdminDashboardController extends AdminBaseController
{
    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('app.menu.dashboard');
        $this->pageIcon = 'icon-speedometer';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->counts = DB::table('users')
            ->select(
                DB::raw('(select count(users.id) from `users` inner join role_user on role_user.user_id=users.id inner join roles on roles.id=role_user.role_id WHERE roles.name = "student") as totalStudents'),
                DB::raw('(select count(users.id) from `users` inner join role_user on role_user.user_id=users.id inner join roles on roles.id=role_user.role_id WHERE roles.name = "supervisor") as totalLecturers'),
                DB::raw('(select count(proposals.id) from `proposals` where status=1)  as totalProjects'),
                DB::raw('(select count(logs.id) from `logs` where approved = 1) as totalLogs'),
                DB::raw('(select count(documentations.id) from `documentations` where status = 1) as totalDocumentations'),
                DB::raw('(select count(notices.id) from `notices`) as totalNotices')
            )
            ->first();
        $this->fromDate = Carbon::today()->subDays(180);
        $this->toDate = Carbon::today();

        return view('admin.dashboard.index', $this->data);
    }
    public function password(){
        return view('admin.dashboard.password', $this->data);
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
//     Alert::success('Password Changed Successfuly', 'Changed!');
        return redirect()->route('admin.dashboard');
    }
}
