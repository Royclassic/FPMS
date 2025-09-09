<?php

namespace App\Http\Controllers\Admin;

use App\Proposal;
use App\Student;
use App\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Faculty;
use App\Course;
use Hash;

class CoordinatorController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('app.menu.employees');
        $this->pageIcon = 'icon-user';
    }

    public function dashboard()
    {

        return view('coodinator.home');
    }


    public function assignStudents()
    {
        $this->students = Student::where('supervisor_id', '=', null)->get();

        $this->supervisors = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('faculties', 'users.faculty_id', '=', 'faculties.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.admission_staff_no', 'faculties.faculty', 'users.email', 'users.created_at')
            ->where(['roles.name' => 'supervisor'])
            ->get();
        return view('admin.supervisors.assign-students', $this->data);

    }

    public function showSupervisorInfor(Request $request)
    {
        if ($request->ajax()) {

            $consult = User::where('id', $request->id)->first();
            //return response($consult);
            return $consult;
        }

    }

    public function assign(Request $request)
    {
        //dd($request->all());
        $supervisor_user_id = $request->supervisor_user_id;
        $totalStudents = Supervisor::where('user_id', $supervisor_user_id)->first()->students->count();
        $supervisor = Supervisor::where('user_id', $supervisor_user_id)->first();
        $student_id = $request->student_user_id;
        $student = Student::find($student_id);
        //$user=User::find($student->id);
        $res = Student::where('user_id', $student_id)->first();
//        if ($user->student->proposal==null){
//            return back()->with('message', 'The selected Student has not proposed any area of interest, advice the to propose a title and broad area of interest');
//        }
        if ($totalStudents <= 9) {
            $res->update(['supervisor_id' => $supervisor->id, 'revoked' => 0]);
        } else {
            return back()->with('message', 'The selected Supervisor has reached a maximum number of Students');
        }

        //dd($res);
        return back();


    }

    public function manageSupervisors()
    {
//        $students=Student::where('supervisor_id', '!=', null)->get();
        $supervisors = Supervisor::join('students', 'supervisors.id', 'students.supervisor_id')
            ->get();

        $students = User::join('students', 'users.id', 'students.user_id')
            ->where('supervisor_id', '!=', null)->get();
        return view('admin.supervisors.manageSupervisors', compact(['supervisors', 'students']));
    }

    public function removeStudent(Request $request)
    {
        $student = Student::find($request->student_id);
        //$totalclients=$consultant->total_clients;
        // $consultant->update(['total_clients'=>$totalclients-1]);
        $student->update(['supervisor_id' => null]);
        return back();

    }

    public function viewProposals()
    {
        $proposals = Proposal::where('completed', 1)->get();
        return view('admin.proposals.index', $this->data, compact(['proposals']));
    }

    public function viewProposal($id)
    {
        $proposal = Proposal::find($id);
        $student = $proposal->student->user;

        return view('admin.proposals.view', $this->data, compact(['proposal', 'student']));
    }

    public function showstudents($id)
    {

        $this->client = User::find($id);
        if ($this->client->supervisor) {
            $this->students = $this->client->supervisor->students;
            return view('admin.supervisors.students', $this->data);
        } else {
            return redirect()->to("coordinator/supervisors/assign/students");
        }


    }
}
