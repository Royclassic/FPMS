<?php

namespace App\Http\Controllers\Supervisor;

use App\Notice;

class SupervisorNoticesController extends SupervisorBaseController
{
    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('app.menu.noticeBoard');
        $this->pageIcon = 'ti-layout-media-overlay';
    }

    public function index() {
        $this->notices = Notice::where('target', '=', 'supervisors')->orderBy('id', 'desc')->limit(10)->get();
        return view('supervisor.notices.index', $this->data);
    }
}
