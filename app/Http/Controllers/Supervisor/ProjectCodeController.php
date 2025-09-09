<?php

namespace App\Http\Controllers\Supervisor;

use Auth;
use App\Code;
use App\Student;

class ProjectCodeController extends SupervisorBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('Project Codes');
        $this->pageIcon = 'icon-docs';

    }

    public function index(){
        $user=Auth::user();
        $this->students=$user->supervisor->students;
        $student=Student::find(17);
       // dd($student->proposal->files);
        //dd($this->students);
        return view('supervisor.codes.index', $this->data);
    }
    public function codes($id){
        $student=Student::find($id);
        $this->proposal=$student->proposal;
        return view('supervisor.codes.view', $this->data);
    }
    public function download($id)
    {
        $file = Code::find($id);
        return response()->download('storage/codes/'.$file->proposal_id.'/'.$file->hashname);
    }

}
