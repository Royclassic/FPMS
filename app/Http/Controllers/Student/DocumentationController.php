<?php

namespace App\Http\Controllers\Student;

use App\Chapterone;
use App\Chapterthree;
use App\Chaptertwo;
use App\Documentation;
use App\Schedule;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class DocumentationController extends StudentBaseController
{
    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('Documentation');
        $this->pageIcon = 'icon-clock';
    }
    public function chapterone(){
        $documentation=Auth::user()->student->documentation;
        $student=Auth::user()->student;
        if($student->proposal==null){
            return redirect()->route('student.proposal.title')->with('message', 'You have to submit your project title before proceeding to project documentation');
        }
        $user=Auth::user();
        $supervisor=$user->student->supervisor;
        return view('student.documentation.chapterone',$this->data, compact(['documentation', 'supervisor', 'user']));
    }
    public function saveChapterOne(Request $request){
        $this->validate($request,['file'=>'required|max:70000|mimes:pdf']);
        $user=Auth::user();
        $documentation_exits=Auth::user()->student->documentation;
        $file=$request->file;
        $fileName='chapterOne.pdf';
        $documentation=Documentation::updateOrCreate(['student_id'=>$user->student->id]);
        $folder=public_path('documentations/'.$user->email);
        if($documentation_exits!==null){
            if($user->student->documentation->chapterOne->file!==null){
                unlink($folder.'/'.$fileName);
                $file->move($folder, $fileName);
                $chapterOne=$user->student->documentation->chapterOne;
                $chapterOne->update(['file'=>$fileName,'comment'=>null, 'completion'=>0, 'status'=>0]);
                return back();
            }
        }
        $file->move($folder, $fileName);
        $chapterOne=Chapterone::updateOrCreate(['documentation_id'=>$documentation->id, 'file'=>$fileName]);
        return back();
    }
    public function chaptertwo(){
        $documentation=Auth::user()->student->documentation;
       // dd($documentation==null);
        $user=Auth::user();
        $student=Auth::user()->student;
        if($student->proposal==null){
            return redirect()->route('proposal.title')->with('message', 'You have to submit your project title before proceeding to project documentation');
        }
        if($documentation==null){
            return redirect()->action('Student\DocumentationController@chapterone')->with('message', 'Please upload this chapter document before proceeding to the next');
        }
        if($documentation->chapterOne->completion==0){
            return redirect()->action('Student\DocumentationController@chapterone')->with('message', 'Please wait for chapter one to be assessed and approved by the supervisor first');
        }
        $supervisor=$user->student->supervisor;
        return view('student.documentation.chaptertwo', $this->data, compact(['documentation', 'supervisor', 'user']));
    }
    public function saveChapterTwo(Request $request){
        $this->validate($request,['file'=>'required|max:70000|mimes:pdf']);
        $user=Auth::user();
        $documentation=Auth::user()->student->documentation;
        $chapterTwoExists=$documentation->chapterTwo;
        $file=$request->file;
        $fileName='chapterTwo.pdf';
        //$documentation=Documentation::updateOrCreate(['student_id'=>$user->student->id]);
        $folder=public_path('documentations/'.$user->email);
        if($chapterTwoExists!==null){
            if($user->student->documentation->chapterTwo->file!==null){
                unlink($folder.'/'.$fileName);
                $file->move($folder, $fileName);
                $chapterTwo=$user->student->documentation->chapterTwo;
                $chapterTwo->update(['file'=>$fileName,'comment'=>null, 'completion'=>0, 'status'=>0]);
                return back();
            }
        }
        $file->move($folder, $fileName);
        Chaptertwo::updateOrCreate(['documentation_id'=>$documentation->id, 'file'=>$fileName]);
        return back();
    }
    public function chapterthree(){
        $documentation=Auth::user()->student->documentation;
        $user=Auth::user();
        $student=$user->student;
        if($student->proposal==null){
            return redirect()->route('proposal.title')->with('message', 'You have to submit your project title before proceeding to project documentation');
        }
        if($documentation==null){
            return redirect()->action('Student\DocumentationController@chapterone')->with('message', 'Please upload this chapter document before proceeding to the next');
        }
        if($documentation->chapterOne->completion==0){
            return redirect()->action('Student\DocumentationController@chapterone')->with('message', 'Please wait for chapter one to be assessed and approved by the supervisor first');
        }
        if($documentation->chapterTwo==null){
            return redirect()->action('Student\DocumentationController@chaptertwo')->with('message', 'Please upload this chapter document before proceeding to the next');
        }
        if($documentation->chapterTwo->completion==0){
            return redirect()->action('Student\DocumentationController@chaptertwo')->with('message', 'Please wait for chapter one to be assessed and approved by the supervisor first');
        }
        $supervisor=$user->student->supervisor;
        return view('student.documentation.chapterthree', $this->data, compact(['documentation', 'supervisor', 'user']));
    }
    public function saveChapterThree(Request $request){
        $this->validate($request,['file'=>'required|max:70000|mimes:pdf']);
        $user=Auth::user();
        $documentation=Auth::user()->student->documentation;
        $chapterThreeExists=$documentation->chapterThree;
        $file=$request->file;
        $fileName='chapterThree.pdf';
        $folder=public_path('documentations/'.$user->email);
        if($chapterThreeExists!==null){
            if($user->student->documentation->chapterTwo->file!==null){
                unlink($folder.'/'.$fileName);
                $file->move($folder, $fileName);
                $chapterThree=$user->student->documentation->chapterThree;
                $chapterThree->update(['file'=>$fileName,'comment'=>null, 'completion'=>0, 'status'=>0]);
                return back();
            }
        }
        $file->move($folder, $fileName);
        Chapterthree::updateOrCreate(['documentation_id'=>$documentation->id, 'file'=>$fileName]);
        return back();
    }
    public function finalDoc(){
        $documentation=Auth::user()->student->documentation;
        $user=Auth::user();
        $student=$user->student;
        $supervisor=$user->student->supervisor;
        if($student->proposal==null){
            return redirect()->route('proposal.title')->with('message', 'You have to submit your project title before proceeding to project documentation');
        }
        if($documentation==null){
            return redirect()->action('Student\DocumentationController@chapterone')->with('message', 'Please upload this chapter document before proceeding to the next');
        }

        if($documentation->chapterOne->completion==0){
            return redirect()->action('Student\DocumentationController@chapterone')->with('message', 'Please wait for chapter one to be assessed and approved by the supervisor first');
        }
        if($documentation->chapterTwo==null){
            return redirect()->action('Student\DocumentationController@chaptertwo')->with('message', 'Please upload this chapter document before proceeding to the next');
        }
        if($documentation->chapterTwo->completion==0){
            return redirect()->action('Student\DocumentationController@chaptertwo')->with('message', 'Please wait for chapter one to be assessed and approved by the supervisor first');
        }
        if($documentation->chapterThree==null){
            return redirect()->action('Student\DocumentationController@chapterthree')->with('message', 'Please upload this chapter document before proceeding to the next');
        }
        if($documentation->chapterThree->completion==0){
            return redirect()->action('Student\DocumentationController@chapterthree')->with('message', 'Please wait for chapter one to be assessed and approved by the supervisor first');
        }
        return view('student.documentation.final', $this->data,compact(['documentation', 'supervisor', 'user']));
    }
    public function savefinal(Request $request){
        $this->validate($request,['final_documentation'=>'required|max:70000|mimes:pdf']);
        $user=Auth::user();
        $documentation=Auth::user()->student->documentation;
        $file=$request->final_documentation;
        $fileName= $user->student->proposal->title->title. ' documentation.pdf';
        $folder=public_path('documentations/'.$user->email);
        if($documentation->final_documentation!==null){
            if($user->student->documentation->final_documentation!==null){
                unlink($folder.'/'.$fileName);
                $file->move($folder, $fileName);
                $final=$user->student->documentation;
                $final->update(['final_documentation'=>$fileName,'comment'=>null, 'completion'=>0, 'status'=>0]);
                return back();
            }
        }
        $file->move($folder, $fileName);
        $documentation->update(['final_documentation'=>$fileName]);
        return back();
    }
    public function ganttChart(){
        $schedules=Auth::user()->student->schedules;

        return view('student.schedules.gantt', compact(['schedules']));
    }
    public function schedule(){

        $schedules=Auth::user()->student->schedules;
        //dd($schedules);
        return view('student.schedules.create', compact(['schedules']));

    }
    public function saveSchedule(Request $request){
        $this->validate($request,['task_name'=>'required|unique:schedules']);
        // dd($request->all());
        $student_id=Auth::user()->student->id;
        $date=Carbon::parse($request->start)->format('d-m-Y');
        $requests=$request->dependency;
        if($requests!==null){
            $val=implode(',', $requests);
            $schedules=Schedule::create(['student_id'=>$student_id, 'task_name'=>$request->task_name,
                'duration'=>$request->duration, 'start'=>$request->start, 'dependency'=>$val]);
        }
        else{
            $schedules=Schedule::create(['student_id'=>$student_id, 'task_name'=>$request->task_name, 'duration'=>$request->duration, 'start'=>$request->start]);
        }
        $schedules=Auth::user()->student->schedules;
        return view('student.schedules.gantt', compact(['schedules']));
    }
}
