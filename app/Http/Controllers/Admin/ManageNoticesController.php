<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Requests\Notice\StoreNotice;
use App\Notice;
use App\Notifications\NewNotice;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Yajra\Datatables\Facades\Datatables;
use Auth;

class ManageNoticesController extends AdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('app.menu.noticeBoard');
        $this->pageIcon = 'ti-layout-media-overlay';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.notices.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notices.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotice $request)
    {

        if($request->target=="supervisors"){
            $notice = new Notice();
            $notice->user_id = Auth::user()->id;
            $notice->heading = $request->heading;
            $notice->target = $request->target;
            $notice->description = $request->description;
            $notice->save();
            $users = User::allEmployees();
            Notification::send($users, new NewNotice($notice));
        }
        if($request->target=="students"){
            $notice = new Notice();
            $notice->user_id = Auth::user()->id;
            $notice->heading = $request->heading;
            $notice->target = $request->target;
            $notice->description = $request->description;
            $notice->save();
            $users = User::allClients();
            Notification::send($users, new NewNotice($notice));
        }

        return Reply::redirect(route('admin.notices.edit', $notice->id), __('messages.noticeAdded'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->notice = Notice::find($id);
        return view('admin.notices.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNotice $request, $id)
    {
        $notice = Notice::find($id);
        if($notice->target="supervisors") {
            $notice->heading = $request->heading;
            $notice->description = $request->description;
            $notice->save();
            Notification::send(User::allEmployees(), new NewNotice($notice));
        }

        if($notice->target="students") {
            $notice = Notice::find($id);
            $notice->heading = $request->heading;
            $notice->description = $request->description;
            $notice->save();
            Notification::send(User::allClients(), new NewNotice($notice));
        }


        return Reply::success(__('messages.noticeUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Notice::destroy($id);
        return Reply::success(__('messages.noticeDeleted'));
    }

    public function data()
    {
        $users = Notice::all();

        return Datatables::of($users)
            ->addColumn('action', function($row){
                return '<a href="'.route('admin.notices.edit', [$row->id]).'" class="btn btn-info btn-circle"
                      data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                      <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                      data-toggle="tooltip" data-user-id="'.$row->id.'" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
            })
            ->editColumn(
                'created_at',
                function ($row) {
                    return Carbon::parse($row->created_at)->format('d F, Y');
                }
            )
            ->make(true);
    }

}
