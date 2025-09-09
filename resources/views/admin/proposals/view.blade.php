@extends('layouts.app')
@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-doc"></i> Proposal Review</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('supervisor.dashboard') }}">Home</a></li>
                <li class="active">Proposal Review</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection
@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/html5-editor/bootstrap-wysihtml5.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/app_1.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/app_2.min.css') }}">
    <link href="{{URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="{{URL::to('summernote/dist/summernote.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="row" style="padding-left: 30px !important;">
        <div class="col-md-12">
            <div class="white-box" style="padding-left: 10px !important;">
                <div class="" style="padding-left: 5px!important; margin-left: 5px" >
                    <div class="t-view" data-tv-type="text">
                        <div class="tv-header media">
                            <a href="" class="tvh-user pull-left">
                                @if($student->image==null)
                                    <img class="img-responsive" src="{{URL::to('default-profile.jpg')}}" alt="">
                                @else
                                     <img class="img-responsive" src="{{URL::to('profile/'. $student->image)}}" alt="">
                                @endif
                            </a>
                            <div class="media-body p-t-5">
                                <strong class="d-block">{{$student->name}}</strong>
                                <small class="c-gray">{{$student->admission_staff_no}}</small>
                            </div>
                        </div>
                        <br>
                        <div class="pm-body clearfix">
                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <div class="pmbb-header">
                                        <h2><i class="zmdi zmdi-library m-r-10"></i>Project Supervisor</h2>
                                    </div>
                                </div>
                                <div class="pmbb-body p-l-30">
                                    <div class="pmbb-view">
                                        <dl class="dl-horizontal">
                                            <dt>Name</dt>
                                            <dd>
                                                {{$student->student->supervisor->user->name}}
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">

                                            <dt>Email</dt>
                                            <dd>
                                                {{$student->student->supervisor->user->email}}
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Phone</dt>
                                            <dd>
                                                {{$student->student->supervisor->user->phone}}
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="pmb-block ">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-wrap-text m-r-10"></i>Project Proposal</h2>
                                </div>
                                <div class="pmbb-body p-l-30">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="pmbb-view">
                                        <dl class="dl-horizontal">
                                            <dt>Field</dt>
                                            <dd>
                                                {{$proposal->field}}
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Sub area</dt>
                                            <dd>
                                                {{$proposal->main_subarea}}
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Proposal file</dt>
                                            <dd>{{$proposal->file}} &nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="{{URL::to('proposals/'.$proposal->file)}}" target="_blank">
                                                    <button class="btn btn-success btn-xs"><i class="zmdi zmdi-eye"></i> View</button>
                                                </a>
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Problem Statement</dt>
                                            <dd>
                                                {!!  $proposal->problem->problem!!}
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Research Objectives</dt>
                                            <dd>
                                                {!! $proposal->objective->objectives!!}
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Research Questions</dt>
                                            <dd>
                                                {!! $proposal->objective->questions !!}
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Status</dt>
                                            @if($proposal->status==0)
                                                <dd><button class="btn btn-warning btn-xs">Approval Pending</button></dd>
                                            @elseif($proposal->status==2)
                                                <dd><button class="btn btn-danger btn-xs">Denied Approval</button></dd>
                                            @else
                                                <dd><button class="btn btn-success btn-xs">Approved</button></dd>
                                            @endif
                                        </dl>

                                        <dl class="dl-horizontal">
                                            <dt>Completed</dt>
                                            <dd>
                                                @if($proposal->completed==0)
                                                    <button class="btn btn-warning btn-xs">Progressing</button>
                                                @else
                                                    <button class="btn btn-success btn-xs">Completed</button>
                                                @endif

                                            </dd>
                                        </dl>
                                        @if($proposal->remarks==null)
                                            <dl class="dl-horizontal">
                                                <dt>Remarks</dt>
                                                <dd>
                                                    <form action="{{route('proposal.remark', $proposal->id)}}" method="POST">
                                                        {{csrf_field()}}
                                                        <div>
                                                            <textarea class="form-control html-editor" placeholder="Write a reply..." name="remark"></textarea>
                                                        </div>

                                                        <button class="m-t-15 btn btn-primary btn-sm" type="submit">Submit</button>

                                                    </form>
                                                </dd>
                                            </dl>
                                        @endif
                                        @if($proposal->remarks==!null)
                                            <dl class="dl-horizontal">
                                                <dt>Remarks</dt>
                                                <dd>
                                                    {!! $proposal->remarks !!}
                                                </dd>
                                            </dl>
                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class=" row text-center" >

                        <a href="{{route('admin.students.proposals')}}">
                            <button  class="btn btn-primary  btn-sm">Back
                            </button>
                        </a>

                    </div>

            </div>
        </div>
    </div>
    </div>

@endsection