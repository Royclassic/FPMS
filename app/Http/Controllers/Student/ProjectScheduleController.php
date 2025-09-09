<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\Schedule;

class ProjectScheduleController extends StudentBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('Project Schedule');
        $this->pageIcon = 'icon-calender';

    }

    public function ganttChart()
    {
        $schedules = Auth::user()->student->schedules;

        return view('student.schedules.gantt', $this->data, compact(['schedules']));
    }

    public function schedule()
    {

        $schedules = Auth::user()->student->schedules;
        // dd($schedules);
        return view('student.schedules.create', $this->data, compact(['schedules']));

    }

    public function saveSchedule(Request $request)
    {
        $this->validate($request, ['task_name' => 'required']);
        //dd($request->all());
        $student_id = Auth::user()->student->id;
        $date = Carbon::parse($request->start)->format('d-m-Y');
        $requests = $request->dependency;
        if ($requests !== null) {
            $val = implode(',', $requests);
            $schedules = Schedule::create(['student_id' => $student_id, 'task_name' => $request->task_name,
                'duration' => $request->duration, 'start' => $request->start, 'dependency' => $val]);
        } else {
            $schedules = Schedule::create(['student_id' => $student_id, 'task_name' => $request->task_name, 'duration' => $request->duration, 'start' => $request->start]);
        }
        $schedules = Auth::user()->student->schedules;
        return back();
    }

    public function show($id)
    {
        $schedule = Schedule::find($id);
        $schedules = Auth::user()->student->schedules;
//        if($schedules!=null){
//            if($schedule->dependency!=null){
//                $dependecies=$schedule->dependecy;
//                dd($dependecies);
//            }
//        }
        return view('student.schedules.edit', $this->data, compact(['schedule', 'schedules']));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);
        $date = Carbon::parse($request->start)->format('d-m-Y');
        $requests = $request->dependency;
        if ($requests !== null) {
            $val = implode(',', $requests);
            $schedule->update(['task_name' => $request->task_name,
                'duration' => $request->duration, 'start' => $request->start, 'dependency' => $val]);
        } else {
            $schedules = $schedule->update(['task_name' => $request->task_name, 'duration' => $request->duration, 'start' => $request->start]);
        }
        return redirect()->route('student.schedule');

    }

    public function delete($id)
    {
        $schedule = Schedule::find($id);
        $schedule->delete();
        return back();

    }

}
