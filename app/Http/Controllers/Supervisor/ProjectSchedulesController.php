<?php

namespace App\Http\Controllers\Supervisor;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ProjectSchedulesController extends SupervisorBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('Projects Schedules');
        $this->pageIcon = 'icon-calender';
    }
    public function index(){
        $user=Auth::user();
        $students=$user->supervisor->students;
        //dd(Student::find(17)->schedules);
        return view('supervisor.schedules.index', $this->data, compact(['students']));

    }
    public function schedule($id){
        $student=Student::find($id);
        $schedules=$student->schedules;
        return view('supervisor.schedules.schedule', $this->data, compact(['student', 'schedules']));

    }
    public function gantt($id){
        $student=Student::find($id);
        $schedules=$student->schedules;
        return view('supervisor.schedules.gantt', $this->data, compact(['student', 'schedules']));

    }
}
