<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Student;
use Carbon\Carbon;
use App\Log;
use PDF;

class StudentLogsController extends StudentBaseController
{
    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('Project Logs');
        $this->pageIcon = 'icon-clock';

    }
    public function index(){
        $student=Auth::user()->student;
        if($student->proposal==null){
            return redirect()->route('student.proposal.title')->with('message', 'You have to submit your project title before proceeding to project logs');
        }
        if($student->proposal->completed==0){
            return redirect()->action('Student\StudentProposalsController@uploadProposal')->with('message', 'Please wait for the supervisor to assess your proposal document before proceeding to logs');
        }
        $now=Carbon::now()->format('Y-m-d H:i:s');
        $project_end=Carbon::parse($student->proposal->deadline);
        $logs=$student->logs;
        return view('student.logs.index', $this->data, compact(['logs', 'now', 'project_end']));
    }
    public function save(Request $request){
        $student=Auth::user()->student;
        $saveLogs=Log::where('student_id', $student->id)->orderBy('id', 'desc')->first();
        if($saveLogs!==null){
            $last=$saveLogs;
            if($last->approved==0){
                return back()->with('warning', 'Please wait for the supervisor to assess your last milestone before submitting the next milestone.');
            }
        }
        $logs=new Log();
        $logs->milestone=$request->milestone;
        $logs->student_id=Auth::user()->student->id;
        $logs->save();
        return back();
    }
    public function fetchMilestone(Request $request,$id)
    {
        if ($request->ajax()) {
            $milestone=Log::find($id);
            return $milestone;
        }
    }
    public function updateMilestone(Request $request){
        $log=Log::find($request->milestone_id);
        $log->update(['milestone'=>$request->milestone]);
        return back();
    }
    public function deleteMilestone(Request $request){
        $log=Log::find($request->id);
        $log->delete();
        return back();
    }
    public function printLog($id){
        $student=Student::find($id);
        $pdf=PDF::loadView('student.logs.print', ['student'=>$student]);
        return $pdf->download( $student->user->name.' project log.pdf');

    }
}
