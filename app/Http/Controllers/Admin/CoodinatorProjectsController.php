<?php

namespace App\Http\Controllers\Admin;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class CoodinatorProjectsController extends AdminBaseController
{
    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('Projects');
        $this->pageIcon = 'icon-layers';
    }
    public function logs(){
        $students=Student::all();
        $student=Student::find(1);
        return view('admin.logs.index', $this->data, compact('students'));
    }
    public function viewLog($id){
        $student=Student::find($id);
        $logs=$student->logs;
        return view('admin.logs.view', $this->data, compact(['student', 'logs']));
    }
    public function documentations(){
        $students=Student::all();
        $student=Student::find(7);
        //dd($student->documentation->final_documentation);
        return view('admin.documentations.index',$this->data, compact(['students']));
    }
    public function printLog($id){
        $student=Student::find($id);
        $pdf=PDF::loadView('supervisor.logs.print', ['student'=>$student]);
        return $pdf->download( $student->user->name.' project log.pdf');

    }
}
