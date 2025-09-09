<?php

namespace App\Http\Controllers\Student;

use App\EmployeeDetails;
use App\Helper\Reply;
use App\Http\Requests\ChatStoreRequest;
use App\Http\Requests\Sticky\StoreStickyNote;
use App\Http\Requests\Sticky\UpdateStickyNote;
use App\StickyNote;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

/**
 * Class SupervisorChatController
 * @package App\Http\Controllers\Supervisor
 */
class StudentStickyNoteController extends StudentBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Sticky Note';
        $this->pageIcon = 'icon-note';
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $this->user = auth()->user();
        $this->noteDetails = StickyNote::where('user_id', $this->user->id)->orderBy('updated_at', 'desc')->get();

        if(\Illuminate\Support\Facades\Request::ajax())
        {
            return   View::make('student.sticky-note.note-ajax', $this->data);

        }

        return View::make('student.sticky-note.index', $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $this->noteDetail = [];

         return View::make('student.sticky-note.create-edit', $this->data);
    }

    /**
     * @param UserStoreRequest $request
     * @return array
     */
    public function store(StoreStickyNote $request)
    {

        $sticky = new StickyNote();
        $sticky->note_text  = $request->get('notetext');
        $sticky->colour     = $request->get('stickyColor');
        if($sticky->colour == ''){
            $sticky->colour = 'blue';
        }
        $sticky->user_id = auth()->user()->id;

        $sticky->save();

        return Reply::success('Note created successfully.');

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $this->iconEdit = 'pencil';
        $this->noteDetail = StickyNote::find($id);

        return View::make('student.sticky-note.create-edit', $this->data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function noteList($id)
    {
        $this->iconEdit = 'pencil';
        // Call the same create view for edit
        $this->noteDetail = StickyNote::find($id);
        return View::make('student.sticky-note.create-edit', $this->data);
    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateStickyNote $request,$id)
    {
        $sticky = StickyNote::find($id);
        $sticky->note_text  = $request->get('notetext');
        $sticky->colour     = $request->get('stickyColor');

        $sticky->save();
        return Reply::success('Note updated successfully.');
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        StickyNote::destroy($id);
        return Reply::success('Note deleted successfully.');
    }

}
