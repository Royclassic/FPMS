<?php

namespace App\Http\Controllers\Admin;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ProjectCodeController extends AdminBaseController
{
    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('Project Codes');
        $this->pageIcon = 'icon-docs';
    }
    public function index(){
        $this->students=Student::all();
        // dd($student->proposal->files);
        //dd($this->students);
        return view('admin.codes.index', $this->data);
    }
    public function codes($id){
        $student=Student::find($id);
        $this->proposal=$student->proposal;
        return view('admin.codes.view', $this->data);
    }
    public function download($id)
    {
        $file = Code::find($id);
        return response()->download('storage/codes/'.$file->proposal_id.'/'.$file->hashname);
    }
}
