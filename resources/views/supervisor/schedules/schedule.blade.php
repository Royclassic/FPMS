@extends('layouts.member-app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ $pageTitle }} for {{ $student->user->name }}</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('supervisor.dashboard') }}">@lang('app.menu.home')</a></li>
                <li><a class="active">{{ $pageTitle }} </a></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/html5-editor/bootstrap-wysihtml5.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/app_1.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/app_2.min.css') }}">
    <link href="{{URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="{{URL::to('summernote/dist/summernote.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                    <!-- <div class="row">
                        <div class="col-sm-6 col-sm-offset-6 text-right">
                            <div class="form-group">
                                <a href="{{ route('supervisor.schedule.gantt', $student->id) }}" class="btn btn-info btn-sm"><i
                                            class="ti-export" aria-hidden="true"></i> View Gantt Chart</a>
                            </div>
                        </div>
                    </div> -->
                    <div class="table-responsive">
                        <table id="example"
                               class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                               id="users-table">
                            <thead>
                            <tr>
                                <!-- <th>Task ID</th> -->
                                <th>Task Name</th>
                                <th>Start</th>
                                <th>Duration</th>
                                <!-- <th>Dependency</th> -->
                                <th>Created on</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schedules as $key=>$project_schedule)
                                <tr>
                                    <!-- <td>{{$project_schedule->id}}</td> -->
                                    <td>{{$project_schedule->task_name}}</td>
                                    <td>{{\Carbon\Carbon::parse($project_schedule->start)->toDateString()}}</td>
                                    <td>{{$project_schedule->duration}} hours</td>
                                    <!-- <td>
                                        {{$project_schedule->dependency}}
                                    </td> -->
                                    <td>{{\Carbon\Carbon::parse($project_schedule->created_at)->toDateTimeString()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{URL::to('plugins/dataTables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{URL::to('plugins/dataTables/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::to('plugins/dataTables/responsive.bootstrap.min.js')}}"></script>
    <script>
        $('.textarea_editor').wysihtml5();

    </script>
@endpush