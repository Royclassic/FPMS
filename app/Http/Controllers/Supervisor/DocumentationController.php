<?php

namespace App\Http\Controllers\Supervisor;

use App\Chapterone;
use App\Chapterthree;
use App\Chaptertwo;
use App\Documentation;
use Illuminate\Http\Request;
use Auth;

class DocumentationController extends SupervisorBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('Documentations');
        $this->pageIcon = 'icon-docs';
    }
    public function documentations(){
        $user=Auth::user();
        $students=$user->supervisor->students;
        return view('supervisor.documentations.index', $this->data, compact(['students']));
    }
    public function viewDocumentation($id){
        $doc=Documentation::find($id);
        return view('supervisor.documentations.view', $this->data, compact(['doc']));
    }
    public function assessChapterOne(Request $request){
        $chapterOne=Chapterone::find($request->chapter_one_id);
        $chapterOne->update(['comment'=>$request->comment,  $this->data,'completion'=>$request->completion, 'status'=>1]);
        return back();
    }
    public function deleteChapterOneAssessment($id){
        $chapterone=Chapterone::find($id);
        $chapterone->update(['comment'=>null, 'status'=>0, 'completion'=>0]);
        return back();
    }
    public function fetchChapterOne(Request $request, $id){
        if($request->ajax()){
            $chapterTwo=Chapterone::find($id);
            return response($chapterTwo);
        }
    }
    public function assessChapterTwo(Request $request){
        $chapterTwo=Chaptertwo::find($request->chapter_two_id);
        $chapterTwo->update(['comment'=>$request->comment, 'completion'=>$request->completion, 'status'=>1]);
        return back();
    }
    public function deleteChapterTwoAssessment($id){
        $chapterone=Chapterone::find($id);
        $chapterone->update(['comment'=>null, 'status'=>0, 'completion'=>0]);
        return back();
    }
    public function fetchChapterTwo(Request $request, $id){
        if($request->ajax()){
            $chapterOne=Chaptertwo::find($id);
            return response($chapterOne);
        }
    }
    public function assessChapterThree(Request $request){
        $chapterThree=Chapterthree::find($request->chapter_three_id);
        $chapterThree->update(['comment'=>$request->comment, 'completion'=>$request->completion, 'status'=>1]);
        return back();
    }
    public function deleteChapterThreeAssessment($id){
        $chapterthree=Chapterthree::find($id);
        $chapterthree->update(['comment'=>null, 'status'=>0, 'completion'=>0]);
        return back();
    }
    public function fetchChapterThree(Request $request, $id){
        if($request->ajax()){
            $chapterThree=Chapterthree::find($id);
            return response($chapterThree);
        }
    }
    public function assessFinal(Request $request){
        $documentation=Documentation::find($request->documentation_id);
        $documentation->update(['comment'=>$request->comment, 'status'=>1, 'completion'=>$request->completion]);
        return back();
    }
    public function deleteFinalAssessment($id){
        $documentation=Documentation::find($id);
        $documentation->update(['comment'=>null, 'status'=>0, 'completion'=>0]);
        return back();
    }
    public function fetchFinal(Request $request, $id){
        if($request->ajax()){
            $chapterThree=Documentation::find($id);
            return response($chapterThree);
        }
    }
}
