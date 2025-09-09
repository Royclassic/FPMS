@extends('layouts.app')
@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> Project Logs</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('student.dashboard.index') }}">@lang('app.menu.home')</a></li>
                <li><a class="active">Project Logs</a></li>
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
    <link rel="stylesheet" href="{{ URL::to('css/app_3.min.css') }}">
    <link href="{{URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="{{URL::to('summernote/dist/summernote.css')}}" rel="stylesheet">
@endpush

@section('content')
    <style>
        .lgi-attrs{
            list-style: none;
            padding: 5px 10px 6px;
            margin: 0;

        }
        .lgi-attrs li{
            border: 1px solid #ccc !important;
            border-color: #4CAF50!important;
            color: #4CAF50;;
        }
        .lgi-attrs li.lgi-approved{
            border-color: #FF9800!important;
            color:#FF9800 !important;
        }
        .lgi-attrs li.lgi-completion{
            border-color: #03A9F4!important;
            color:#03A9F4 !important;
        }
        .lgi-attrs li.lgi-pending{
            border-color: #FF9800!important;
            color:#FF9800 !important;
        }
        .action-header{padding:25px 30px;line-height:100%;position:relative;z-index:1;min-height:65px;background-color:#F7F7F7}
    </style>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12" >
            <div class="white-box">
                <div class="card">
                    @if(Session::has('message'))
                        <p class="alert alert-danger">{{ Session::get('message') }}</p>
                    @endif
                    <div class="card-header">
                        <h2>Milestone
                            <small>Current Progress logs for the student with the supervisor </small>
                        </h2>
                    </div>

                    <div class="card-body card-padding">
                        <div class="list-group lg-odd-black">
                            <div class="action-header clearfix">
                                <div class="ah-label hidden-xs">Progress Logs for {{$student->user->name}} supervised by {{$student->supervisor->user->name}}</div>

                                <div class="ah-search">
                                    <input type="text" placeholder="Start typing..." class="ahs-input">

                                    <i class="ahs-close" data-ma-action="action-header-close">&times;</i>
                                </div>

                                <!-- <ul class="actions">
                                    <li class="dropdown">
                                        <a href="{{route('admin.logs.print', $student->id)}}" style="color: darkgreen; font-size: 24px">
                                            <i style="color: darkgreen; font-size: 30px" class="zmdi zmdi-local-printshop"></i>
                                        </a>

                                    </li>
                                </ul> -->
                            </div>
                            @foreach($logs as $log)
                                <div class="list-group-item media">
                                    <div class="checkbox pull-left">
                                        <label>
                                            <input type="checkbox" value="">
                                            <i class="input-helper"></i>
                                        </label>
                                    </div>
                                    <div class="media-body">
                                        <div class="lgi-heading" style="overflow: auto;">{{$log->milestone}}</div>
                                        <small class="lgi-text"><b>Supervisor additional :</b> {{$log->additional_tasks}}</small>
                                        @if($log->comments!==null)
                                            <div class="list-group-item media" style="background-color: inherit!important;">
                                                <div style="padding-left: 15px;">
                                                </div>
                                                <div class="pull-left">
                                                    @if($student->supervisor->user->image==!null)
                                                        <img class="lgi-img" src="{{url('profile/'.$student->supervisor->user->image)}}" alt="">
                                                    @else
                                                        <img class="lgi-img" src="{{URL::to('default-profile.jpg')}}" alt="">
                                                    @endif
                                                </div>

                                                <div class="media-body">
                                                    <div class="lgi-heading">{{$student->supervisor->user->name}}</div>
                                                    <small class="lg-hide-items">{{$log->comments}}</small>
                                                </div>
                                            </div>
                                        @endif
                                        <ul class="lgi-attrs">
                                            <li class="f-500">Date Created: {{$log->created_at->toDayDateTimeString()}}</li>
                                            @if($log->approved==1)
                                                <li class="f-500">Approved: Yes</li>
                                            @elseif($log->approved==0)
                                                <li class="f-500">Approved: Pending</li>
                                            @endif
                                            <li class="f-500">Assessed on : {{$log->updated_at->toDayDateTimeString()}} </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        @if(!empty($warning))
                            <p class="alert alert-danger">{{ $warning }}</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer-script')
    <script src="{{ asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/html5-editor/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{URL::to('summernote/dist/summernote.js')}}"></script>
@endpush