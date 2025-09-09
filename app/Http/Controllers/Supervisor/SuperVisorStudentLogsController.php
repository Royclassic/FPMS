<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use App\Log;
use App\Proposal;
use App\Student;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\Controller;
use PDF;

class SuperVisorStudentLogsController extends SupervisorBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('Logs');
        $this->pageIcon = 'icon-clock';
    }
    public function logs(){
        $user=Auth::user();
        // dd(Student::find(7)->logs);
        //$students=$user->supervisor->students;
        $students=Student::where('supervisor_id', $user->supervisor->id)->get();
        // dd($students);
        return view('supervisor.logs.index', $this->data, compact(['students']));
    }
    public function viewlog($id){
        $student=Student::find($id);
        $logs=$student->logs;
        return view('supervisor.logs.view', $this->data, compact(['student', 'logs']));
    }
    public function saveAdditionalTask(Request $request){
        $log=Log::find($request->milestone_id);
        $log->update(['additional_tasks'=>$request->additional_task]);
        return back();
    }
    public function approveLog($id){
        $log=Log::find($id);
        $log->update(['approved'=>1]);
        return back();
    }
    public function saveComments(Request $request){
        $log=Log::find($request->milestone_id);
        $log->update(['comments'=>$request->comments, 'signed'=>1,'approved'=>1, 'completion'=>$request->completion]);
        return back();
    }
    public function fetchComment(Request $request, $id){
        if($request->ajax()){
            $log=Log::find($id);
            return response($log);
        }
    }
    public function updateComments(Request $request){
        $log=Log::find($request->milestone_id);
        $log->update(['comments'=>$request->comments, 'completion'=>$request->completion]);
        return back();
    }
    public function deleteComments(Request $request){
        $log=Log::find($request->id);
        $log->update(['comments'=>null, 'signed'=>0]);
        return back();
    }
    public function deadline(Request $request){
        $proposal=Proposal::find($request->id);
        $deadline=Carbon::parse($request->deadline)->format('Y-m-d H:i:s');
        $proposal->update(['deadline'=>$deadline]);
        return back();
    }
    public function printLog($id){
        $student=Student::find($id);
        $pdf=PDF::loadView('supervisor.logs.print', ['student'=>$student]);
        return $pdf->download( $student->user->name.' project log.pdf');

    }

}
