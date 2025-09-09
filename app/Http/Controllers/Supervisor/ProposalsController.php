<?php

namespace App\Http\Controllers\Supervisor;

use App\Objective;
use App\ObjectiveReview;
use App\Problem;
use App\ProblemReview;
use App\Proposal;
use App\ProposalReview;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Title;
use App\TitleReview;

class ProposalsController extends SupervisorBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('Proposals');
        $this->pageIcon = 'icon-people';
    }
    public function titles(){
        $user=Auth::user();
        $students=$user->supervisor->students;
        return view('supervisor.proposals.titles',$this->data, compact(['students']));
    }
    public function viewTitle($id){
        $title=Title::find($id);
        $student=$title->proposal->student->user;
        return view('supervisor.proposals.viewtitle', $this->data,   compact(['student', 'title']));
    }
    public function reviewTitle(Request $request, $id){
        $user_id=Auth::user()->id;
        TitleReview::create(['user_id'=>$user_id,'title_id'=>$id, 'review'=>$request->review]);
        return back();

    }
    public function approveTitle($id){
        $title=Title::find($id);
        $title->update(['status'=>1]);
        return back();
    }
    public function disapprove($id){
        $title=Title::find($id);
        $title->update(['status'=>2]);
        return back();
    }
    public function problems(){
        $user=Auth::user();
        // dd(Student::find(4)->proposal);
        $students=$user->supervisor->students;
        return view('supervisor.proposals.problems',$this->data, compact(['students']));
    }
    public function viewProblem($id){
        $problem=Problem::find($id);
        $user=$problem->proposal->student->user;
        $student=$problem->proposal->student->user;
        return view('supervisor.proposals.viewProblem',$this->data, compact(['user','student', 'problem']));

    }
    public function reviewProblem(Request $request, $id){
        $user_id=Auth::user()->id;
        ProblemReview::create(['user_id'=>$user_id,'problem_id'=>$id, 'review'=>$request->review]);
        return back();
    }
    public function approveProblem($id){
        $problem=Problem::find($id);
        $problem->update(['status'=>1]);
        return back();
    }
    public function disapproveProbem($id){
        $problem=Problem::find($id);
        $problem->update(['status'=>2]);
        return back();
    }
    public function objectives(){
        $user=Auth::user();
        $students=$user->supervisor->students;
        return view('supervisor.proposals.objectives', $this->data, compact(['students']));
    }
    public function viewObjective($id){
        $objective=Objective::find($id);
        $student=$objective->proposal->student->user;
        return view('supervisor.proposals.viewObjective',$this->data, compact(['student', 'objective']));
    }
    public function reviewObjective (Request $request, $id){
        $user_id=Auth::user()->id;
        ObjectiveReview::create(['user_id'=>$user_id,'objective_id'=>$id, 'review'=>$request->review]);
        return back();
    }
    public function approveObjective($id){
        $objective=Objective::find($id);
        $objective->update(['status'=>1]);
        return back();
    }
    public function disapproveObjective($id){
        $objective=Objective::find($id);
        $objective->update(['status'=>2]);
        return back();
    }
    public function viewProposals(){
        $user=Auth::user();
        $students=$user->supervisor->students;
        return view('supervisor.proposals.proposals', $this->data,compact(['students']));
    }
    public function viewProposal($id){
        $proposal=Proposal::find($id);
        $student=$proposal->student->user;
        return view('supervisor.proposals.viewProposal',$this->data, compact(['proposal','student']));

    }
    public function reviewProposal(Request $request, $id){
        $proposal= Proposal::find($id);
        $user_id=Auth::user()->id;
        ProposalReview::create(['user_id'=>$user_id,'proposal_id'=>$proposal->id, 'review'=>$request->review]);
        return back();
    }
    public function approveProposal($id){
        $proposal=Proposal::find($id);
        $proposal->update(['status'=>1]);
        return back();
    }
    public function disapproveProposal($id){
        $proposal=Proposal::find($id);
        $proposal->update(['status'=>2]);
        return back();
    }
    public function proposalsAssessment(){
        $user=Auth::user();
        $students=$user->supervisor->students;

        return view('supervisor.proposals.assessments',$this->data, compact(['students']));

    }
    public function proposalAssessment($id){
        $proposal=Proposal::find($id);
        $student=$proposal->student->user;
        return view('supervisor.proposals.assessment', $this->data, compact(['student','proposal']));
    }
    public function remark(Request $request, $id){
        $proposal= Proposal::find($id);
        $proposal->update(['remarks'=>$request->remark, $this->data,'completed'=>1]);
        return back();

    }

}
