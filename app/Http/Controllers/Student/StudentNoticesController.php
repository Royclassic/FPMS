<?php

namespace App\Http\Controllers\Student;

use App\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentNoticesController extends StudentBaseController
{
    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('app.menu.noticeBoard');
        $this->pageIcon = 'ti-layout-media-overlay';
    }

    public function index() {
        $this->notices = Notice::where('target', '=', 'students')->orderBy('id', 'desc')->limit(10)->get();

        return view('student.notices.index', $this->data);
    }
}
