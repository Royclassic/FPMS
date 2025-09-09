<?php

namespace App\Http\Controllers\Student;

use App\Helper\Reply;
use App\Project;
use App\ProjectFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentFilesController extends StudentBaseController
{

    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('app.menu.projects');
        $this->pageIcon = 'icon-layers';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = new ProjectFile();
            $file->user_id = $this->user->id;
            $file->project_id = $request->project_id;

            $request->file->store('public/project-files/'.$request->project_id);
            $file->filename = $request->file->getClientOriginalName();
            $file->hashname = $request->file->hashName();

            $file->size = $request->file->getSize();
            $file->save();
            $this->logProjectActivity($request->project_id, ucwords($this->user->name).__('messages.clientUploadedAFileToTheProject'));
        }

        $this->project = Project::find($request->project_id);
        $view = view('student.project-files.ajax-list', $this->data)->render();
        return Reply::successWithData(__('messages.fileUploadedSuccessfully'), ['html' => $view]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->project = Project::find($id);
        if($this->project->checkProjectClient()){
            return view('student.project-files.show', $this->data);
        }
        else{
            return redirect(route('student.dashboard.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
