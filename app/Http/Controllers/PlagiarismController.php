<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plagiarism\Reports;

class PlagiarismController extends Controller
{
    public function callback(Request $request){
        dd('here');
        dd($request->all());
    }
    public function form(){
        return view('test');
    }
    public function test(){
    //     $data = [
    //     'text' => 'PlagiarismSearch.com – advanced online plagiarism checker available 24/7. PlagiarismSearch.com is a leading plagiarism checking website that will provide you with an accurate report during a short timeframe. Prior to submitting your home assignments, run them through our plagiarism checker to make sure your content is authentic.'
    // ];
        // $files=[
        //     'file'=>public_path('pdf-sample.pdf')
        // ];
        $data = [
        'url' => 'http://che.org.il/wp-content/uploads/2016/12/pdf-sample.pdf', // public url
        ];
        $report =new Reports();

        $report->createAction($data);
    }
    public function getCallback(Request $request){
        dd($request->all());
    }


}
