<?php

namespace App\Http\Controllers\Supervisor;

use App\Documentation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlagiarismController extends SupervisorBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('Proposals');
        $this->pageIcon = 'icon-docs';
    }
    public function proposals($proposal){
        $proposal=$proposal;
        return view('supervisor.plagiarism.proposals', $this->data, compact(['proposal']) );

    }
    public function documentations($documentation){
        $doc=(int)$documentation;
        $documentation=Documentation::find($doc);
        return view('supervisor.plagiarism.documentations', $this->data, compact(['documentation']) );

    }
}
