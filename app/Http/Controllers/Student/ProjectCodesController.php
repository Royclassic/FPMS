<?php

namespace App\Http\Controllers\Student;

use App\Helper\Reply;
use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Code;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Auth;

class ProjectCodesController extends StudentBaseController
{
    public function __construct() {
        parent::__construct();
        $this->pageIcon = 'icon-docs';
        $this->pageTitle = __('app.menu.projects');
    }
    public function index()
    {
        $student=Auth::user()->student;
        if($student->proposal==null){
            return redirect()->route('student.proposal.title')->with('message', 'You have to submit your project title before proceeding to project logs');
        }
        if($student->proposal->completed==0){
            return redirect()->action('Student\StudentProposalsController@uploadProposal')->with('message', 'Please wait for the supervisor to assess your proposal documet before proceeding to logs');
        }
        $student=Auth::user()->student;
        $proposal=$student->proposal;
//        dd($proposal->files)
        return view('student.code.index', $this->data, compact(['proposal']));
    }
    public function store(Request $request)
    {

        if ($request->hasFile('file')) {
            $file = new Code();
            $file->proposal_id = $request->proposal_id;

            $request->file->store('public/codes/'.$request->proposal_id);
            $file->filename = $request->file->getClientOriginalName();
            $file->hashname = $request->file->hashName();

            $file->size = $request->file->getSize();
            $file->save();
        }

        $this->proposal = Proposal::find($request->proposal_id);
        $view = view('student.code.ajax-list', $this->data)->render();
        return Reply::successWithData(__('messages.fileUploaded'), ['html' => $view]);
    }
    public function show($id)
    {
        $this->project = Project::find($id);
        return view('student.code.show', $this->data);
    }
    public function overview(){
        $student=Auth::user()->student;
        if($student->proposal==null){
            return redirect()->route('student.proposal.title')->with('message', 'You have to submit your project title before proceeding to project logs');
        }
        if($student->proposal->completed==0){
            return redirect()->action('Student\StudentProposalsController@uploadProposal')->with('message', 'Please wait for the supervisor to assess your proposal documet before proceeding to logs');
        }
        $student=Auth::user()->student;
       $this->proposal=$student->proposal;
       return view('student.code.instructions', $this->data);
    }


    public function destroy($id)
    {
        $file = Code::find($id);
        File::delete('storage/codes/'.$file->proposal_id.'/'.$file->hashname);
       // unlink(storage_path('app/public/codes/'.$file->proposal_id.'/'.$file->hashname));
        Code::destroy($id);
        $this->proposal = Proposal::find($file->proposal_id);
        $view = view('student.code.ajax-list', $this->data)->render();
        return Reply::successWithData(__('messages.fileDeleted'), ['html' => $view]);
    }


    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id)
    {
        $file = Code::find($id);
        return response()->download('storage/codes/'.$file->proposal_id.'/'.$file->hashname);
    }

}
