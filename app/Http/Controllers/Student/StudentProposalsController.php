<?php

namespace App\Http\Controllers\Student;
use App\Objective;
use App\ObjectiveReview;
use App\Problem;
use App\ProblemReview;
use App\Proposal;
use App\ProposalReview;
use App\Title;
use App\TitleReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentProposalsController extends StudentBaseController

{
    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('Proposal Title');
        $this->pageIcon = 'ti-layout-media-overlay';
    }
    public function title(){

       $proposal= Auth::user()->student->proposal;
       $user=Auth::user();
       $supervisor=$user->student->supervisor;
        return view('student.proposals.title', $this->data, compact(['proposal', 'user', 'supervisor']));
    }
    public function saveTitle(Request $request){
        //dd($request->all());
        $user=Auth::user()->student;
        $proposal=Proposal::create(['student_id'=>$user->id, 'subareas'=>$request->subareas]);

        // $proposal=Proposal::create(['student_id'=>$user->id, 'field'=>$request->field,
        //     'subareas'=>$request->subareas, 'main_subarea'=>$request->main_subarea]);
        $title=Title::create(['proposal_id'=>$proposal->id, 'title'=>$request->title]);
        return back();

    }
    public function replyTitle(Request $request){
        $user=Auth::user();
        $title=$user->student->proposal->title;
        TitleReview::create(['user_id'=>$user->id, 'title_id'=>$title->id, 'review'=>$request->review]);
        return back();

    }
    public function editTitle($id){

        //$title=Title::find($id);
        $title=Title::join('proposals', 'proposals.id', 'titles.proposal_id')->where('titles.id',$id)->first();
        return $title;
    }
    public function reProposeTitle(Request $request){
        $proposal=Auth::user()->student->proposal;
        // $proposal->update(['field'=>$request->field,
        //     'subareas'=>$request->subareas, 'main_subarea'=>$request->main_subarea]);
        $proposal->update(['subareas'=>$request->subareas]);
        $title=Auth::user()->student->proposal->title;
        $title->update(['title'=>$request->title, 'status'=>0]);
        return back();
    }
    public function problemStatement(){
        $proposal=Auth::user()->student->proposal;
        if($proposal==null){
            return redirect()->action('Student\StudentProposalsController@title')->with('message', 'Please submit your project title before submitting the proposal problem statement' );
        }
        if($proposal->title->status==0 || $proposal->title->status==2){
            return redirect()->action('Student\StudentProposalsController@title')->with('message', 'Please wait for your title to be approved by the supervisor before proceeding to upload the problem statement' );
        }
        $problem=$proposal->problem;
        $user=Auth::user();
        $supervisor=$user->student->supervisor;
        return view('student.proposals.problem', $this->data, compact(['proposal', 'user', 'supervisor', 'problem']));
    }
    public function saveProblem(Request $request){
        $user=Auth::user();
        $proposal=$user->student->proposal;
        Problem::create(['proposal_id'=>$proposal->id, 'problem'=>$request->problem]);
        return back();
    }
    public function editProblem($id){
        $problem=Problem::find($id);
        return $problem;
    }
    public function updateProblem(Request $request){
        //dd($request->all());
        $user=Auth::user()->student;
        $problem=$user->proposal->problem;
        $problem->update(['problem'=>$request->problem, 'status'=>0]);
        return back();

    }
    public function replyProblem( Request $request){
        $user=Auth::user();
        $problem=$user->student->proposal->problem;
        ProblemReview::create(['user_id'=>$user->id, 'problem_id'=>$problem->id, 'review'=>$request->review]);
        return back();
    }
    public function objectives(){
        $proposal=Auth::user()->student->proposal;
              ;

        if($proposal==null){
            return redirect()->route('student.proposal.title')->with('message', 'You have to submit your project title before proceeding to project documentation');
        }
        if($proposal->problem==null){
            return redirect()->action('Student\StudentProposalsController@problemStatement')->with('message', 'Please submit problem statement before submitting the objectives');
        }
        if($proposal->problem->status==0 || $proposal->problem->status==2){
            return redirect()->action('Student\StudentProposalsController@problemStatement')->with('message', 'Please wait for your Problem Statement to be approved by the supervisor before proceeding to upload the research objectives');
        }
        $problem=$proposal->problem;
        $objective= $proposal->objective;
        $user=Auth::user();
        $supervisor=$user->student->supervisor;
        return view('student.proposals.objectives', $this->data, compact(['proposal', 'user', 'supervisor', 'objective']));
    }
    public function saveObjectives(Request $request){
        $user=Auth::user();
        $proposal=$user->student->proposal;
        Objective::create(['proposal_id'=>$proposal->id, 'questions'=>$request->questions, 'objectives'=>$request->objectives]);
        return back();
    }
    public function replyObjective ( Request $request){
        $user=Auth::user();
        $problem=$user->student->proposal->objective;
        ObjectiveReview::create(['user_id'=>$user->id, 'objective_id'=>$problem->id, 'review'=>$request->review]);
        return back();
    }
    public function editObjectives($id){
        $objective=Objective::find($id);
        return $objective;
    }
    public function updateObjective(Request $request){
        //dd($request->all());
        $user=Auth::user()->student;
        $problem=$user->proposal->objective;
        $problem->update(['questions'=>$request->questions, 'objectives'=>$request->objectives,'status'=>0]);
        return back();
    }
    public function uploadProposal(){
        $proposal=Auth::user()->student->proposal;
        $user=Auth::user();
        if($proposal==null){
            return redirect()->route('student.proposal.title')->with('message', 'You have to submit your project title before proceeding to project documentation');
        }
        $objective=$proposal->objective;
        if($proposal->objective==null){
            return redirect()->action('Student\StudentProposalsController@objectives')->with('message', 'Please Upload your objectives first');
        }

        if($proposal->objective->status==0 || $proposal->objective->status==2){
            return redirect()->action('Student\StudentProposalsController@objectives')->with('message', 'Please wait for your Objectives to be approved by the supervisor before proceeding  to upload the proposal document');
        }
        $user=Auth::user();

        $supervisor=$user->student->supervisor;
        return view('student.proposals.uploadProposal', $this->data, compact(['proposal', 'user', 'supervisor']));
    }
    public function saveProposal(Request $request){
        $this->validate($request,['file'=>'required|max:50000|mimes:pdf']);
        $user=Auth::user();
        $file=$request->file;
        $fileName=$user->student->proposal->title->title.'.pdf';
        $imagename=$file->getClientOriginalName();
        $proposal=Auth::user()->student->proposal;
        $proposal->file=$fileName;
        $file->move('proposals', $fileName);
        $proposal->save();

        return back();

    }
    public function replyProposal(Request $request){
        $user=Auth::user();
        $proposal=$user->student->proposal;
        ProposalReview::create(['user_id'=>$user->id, 'proposal_id'=>$proposal->id, 'review'=>$request->review]);
        return back();
    }
    public function updateProposal(Request $request){
        $this->validate($request,['file'=>'required|max:50000|mimes:pdf']);
        $filename=Auth::user()->student->proposal->file;
        $path = public_path().'/proposals/'.$filename;
        unlink($path);
        $user=Auth::user();
        $file=$request->file;
        $fileName=$user->student->proposal->title->title.'.pdf';
        $proposal=Auth::user()->student->proposal;
        $proposal->file=$fileName;
        $proposal->status=0;
        $file->move('proposals', $fileName);
        $proposal->save();
        return back();
    }
}