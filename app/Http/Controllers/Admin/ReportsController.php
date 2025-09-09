<?php

namespace App\Http\Controllers\Admin;

use App\Documentation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Proposal;
use App\Student;
use PDF;
class ReportsController extends AdminBaseController
{
    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('Reports');
        $this->pageIcon = 'icon-docs';
    }
    public function students(){
        $students = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('courses', 'users.course_id', '=', 'courses.id')
            ->leftJoin('faculties', 'users.faculty_id', '=', 'faculties.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name','users.phone', 'users.admission_staff_no', 'faculties.faculty', 'courses.course','users.email', 'users.created_at')
            ->where('roles.name', 'student')
            ->get();
        return view('admin.reports.students.index', $this->data, compact('students'));
    }
    public function studentgenerate(Request $request){
        if($request->report=='all'){
            $students = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                ->leftJoin('courses', 'users.course_id', '=', 'courses.id')
                ->leftJoin('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.name', 'users.admission_staff_no', 'faculties.faculty', 'courses.course','users.email', 'users.created_at')
                ->where('roles.name', 'student')
                ->get();
            $pdf=PDF::loadView('admin.reports.students.all',['students'=>$students]);
            return $pdf->download('all students.pdf');
        }
        if($request->report=='active'){
            $students = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                ->leftJoin('courses', 'users.course_id', '=', 'courses.id')
                ->leftJoin('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.passrec', 'users.name', 'users.admission_staff_no', 'faculties.faculty', 'courses.course','users.email', 'users.created_at')
                ->where('roles.name', 'student')
                ->get();
            //dd($students);
            $pdf=PDF::loadView('admin.reports.students.active_students',['students'=>$students]);
            return $pdf->download(' active students.pdf');
        }
        if($request->report=='inactive'){
            $students = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                ->leftJoin('courses', 'users.course_id', '=', 'courses.id')
                ->leftJoin('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.name', 'users.passrec', 'users.admission_staff_no', 'faculties.faculty', 'courses.course','users.email', 'users.created_at')
                ->where('roles.name', 'student')
                ->get();
            $pdf=PDF::loadView('admin.reports.students.inactive_students',['students'=>$students]);
            return $pdf->download('inactive students.pdf');
        }


    }
    public function supervisors(){
        return view('admin.reports.supervisors.index', $this->data);
    }
    public function supervisorgenerate(Request $request){
        if($request->report=='all'){
            $supervisor = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                ->leftJoin('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.name', 'users.admission_staff_no', 'faculties.faculty', 'users.email', 'users.created_at')
                ->where('roles.name', 'supervisor')
                ->get();
            $pdf=PDF::loadView('admin.reports.supervisors.all',['supervisors'=>$supervisor]);
            return $pdf->download('all system supervisor.pdf');
        }
        if($request->report=='active'){
            $supervisor = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                ->leftJoin('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.name', 'users.passrec', 'users.admission_staff_no', 'faculties.faculty', 'users.email', 'users.created_at')
                ->where('roles.name', 'supervisor')
                ->get();
            $pdf=PDF::loadView('admin.reports.supervisors.active_supervisors',['supervisors'=>$supervisor]);
            return $pdf->download('active supervisors.pdf');
        }
        if($request->report=='inactive'){
            $supervisor = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                ->leftJoin('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.name', 'users.passrec', 'users.admission_staff_no', 'faculties.faculty', 'users.email', 'users.created_at')
                ->where('roles.name', 'supervisor')
                ->get();
            $pdf=PDF::loadView('admin.reports.supervisors.inactive_supervisors',['supervisors'=>$supervisor]);
            return $pdf->download('inactive supervisors.pdf');
        }
        if($request->report=='assignedStudents'){
            $supervisors = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
                ->leftJoin('supervisors', 'users.id', '=', 'supervisors.user_id')
                ->leftJoin('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->select('users.id as id', 'roles.id as role_id', 'users.name as name',
                    'users.admission_staff_no', 'faculties.faculty', 'users.email', 'supervisors.id as supervisor_id')
                ->where('roles.name', 'supervisor')
                ->get();
            //dd($supervisors);
            $pdf=PDF::loadView('admin.reports.supervisors.assigned_students',['supervisors'=>$supervisors]);
            return $pdf->download('assigned students to supervisors.pdf');
        }


    }
    public function proposals(){
        return view('admin.reports.proporsals.index', $this->data);
    }
    public function proposalgenerate(Request $request){
        if($request->report=='completed'){
            $proposals=Proposal::where('completed', 1)->get();
            $pdf=PDF::loadView('admin.reports.proporsals.completed',['proposals'=>$proposals]);
            return $pdf->download('completed project proposals');
        }

    }

    public function documentations(){
        return view('admin.reports.documentations.index', $this->data);
    }
    public function documentationgenerate(Request $request){
        if($request->report=='completed'){
            $students=Student::all();
            $pdf=PDF::loadView('admin.reports.documentations.completed',['students'=>$students]);
            return $pdf->download('completed project documentations');
        }

    }

}
