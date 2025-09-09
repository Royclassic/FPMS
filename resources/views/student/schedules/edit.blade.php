@extends('layouts.client-app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-calender}"></i> Edit Task</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('student.dashboard.index') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('student.schedule') }}">{{ $pageTitle }}</a></li>
                <li class="active">Edit</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"> Update Task</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                       <form method="POST" action="{{route('student.schedules.update', $schedule->id)}}">
                           {{csrf_field()}}
                        <div class="form-body">
                            <h3 class="box-title m-t-40">Task Details</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label>Task Name</label>
                                        <input type="text" name="task_name" id="task_name" value="{{ $schedule->task_name }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start</label>
                                        <input type="date" name="start" id="start"  value="{{ $schedule->start }}" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Duration /hour</label>
                                        <input type="number" name="duration" id="duration" value="{{$schedule->duration}}" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->

                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dependency</label>
                                        <select class="form-control selectpicker" multiple
                                                data-max-options="10" name="dependency[]">
                                            @foreach($schedules as $schedule)
                                                <option value="{{$schedule->id}}">{{$schedule->task_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
                                <!--/span-->
                            </div>
                            <!--/row-->

                        </div>
                        <div class="form-actions">
                            <button type="submit" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.update')</button>
                            <a href="{{ route('student.schedule') }}" class="btn btn-default">@lang('app.back')</a>
                        </div>
                        <form>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- .row -->

@endsection
