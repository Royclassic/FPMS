<?php

namespace App\Http\Controllers\Supervisor;

use App\Attendance;
use App\Issue;
use App\Project;
use App\ProjectActivity;
use App\ProjectTimeLog;
use App\Task;
use Auth;
use Hash;

class SupervisorDashboardController extends SupervisorBaseController
{
    public function __construct() {
        parent::__construct();

        $this->pageTitle = __('app.menu.dashboard');
        $this->pageIcon = 'icon-speedometer';
    }

    public function index() {
        $this->students=Auth::user()->supervisor->students;
        return view('supervisor.dashboard.index', $this->data);
    }
    public function updatePassword(){

        return view('member.dashboard.updatepassword');
    }
}
