@extends('layouts.client-app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ $pageTitle }}</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('student.dashboard.index') }}">@lang('app.menu.home')</a></li>
                <li><a class="active">{{ $pageTitle }}</a></li>
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
                @if($schedules==null)
                    <div class="card">
                        <form class="form-horizontal" role="form" action="{{route('student.schedules.save')}}"
                              method="POST">
                            {{csrf_field()}}
                            @if(Session::has('message'))
                                <p class="alert alert-danger">{{ Session::get('message') }}</p>
                            @endif
                            @if(!empty($warning))
                                <p class="alert alert-danger">{{ $warning }}</p>
                            @endif
                            <div class="card-header">
                                <h2>Project Schedule
                                    <small>Submit your project for the gannt chart to be generated</small>
                                </h2>
                            </div>


                            <div class="card-body card-padding">
                                <div class="form-group">
                                    <label for="old_password" class="col-sm-12 control-label" style="text-align: left;"><b>Task
                                            Name</b></label>
                                    <div class="col-sm-12">
                                        <div class="fg-line{{ $errors->has('task_name') ? ' has-error' : '' }}">
                                            <input type="text" class="form-control input-sm" id="task_name"
                                                   name="task_name" required>
                                            @if ($errors->has('task_name'))
                                                <span class="help-block">
                                    <strong>{{ $errors->first('task_name') }}</strong>
                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="start" class="col-sm-12 control-label" style="text-align: left;"><b>Start
                                            Date</b></label>
                                    <div class="col-sm-12">
                                        <div class="fg-line{{ $errors->has('start') ? ' has-error' : '' }}">
                                            <input type="date" class="form-control input-sm" id="start"
                                                   name="start" required>
                                            @if ($errors->has('start'))
                                                <span class="help-block">
                                    <strong>{{ $errors->first('start') }}</strong>
                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="duration" class="col-sm-12 control-label"
                                           style="text-align: left;"><b>Duration /hour</b></label>
                                    <div class="col-sm-12">
                                        <div class="fg-line{{ $errors->has('duration') ? ' has-error' : '' }}">
                                            <input type="number" class="form-control input-sm" id="duration"
                                                   name="duration" required>
                                            @if ($errors->has('duration'))
                                                <span class="help-block">
                                    <strong>{{ $errors->first('duration') }}</strong>
                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- @if(count($schedules))

                                    <div class="form-group">
                                        <label for="duration" class="col-sm-12 control-label" style="text-align: left;"><b>Dependency</b></label>
                                        <div class="col-sm-12">
                                            <div class="fg-line{{ $errors->has('dependency') ? ' has-error' : '' }}">
                                                <select class="form-control selectpicker" multiple
                                                        data-max-options="6" name="dependency[]">

                                                    @foreach($schedules as $schedule)
                                                        <option value="{{$schedule->id}}">{{$schedule->task_name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('dependency'))
                                                    <span class="help-block">
                                    <strong>{{ $errors->first('dependency') }}</strong>
                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif -->
                                <div class="form-group">
                                    <div class=" col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-sm" type="submit">Submit
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                @else
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <a onclick="return newTask()" class="btn btn-outline btn-success btn-sm">Add New Task <i
                                            class="fa fa-plus" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
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
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($schedules as $key=>$project_schedule)
                                <tr>
                                    <!-- <td>{{$project_schedule->id}}</td> -->
                                    <td>{{$project_schedule->task_name}}</td>
                                    <td>{{\Carbon\Carbon::parse($project_schedule->start)->toDateString()}}</td>
                                    <td>{{$project_schedule->duration}} hours</td>
                                    <!-- <td>
                                        {{$project_schedule->dependency}}
                                    </td> -->
                                    <td>{{\Carbon\Carbon::parse($project_schedule->created_at)->toDateTimeString()}}</td>
                                    <td><a href="{{route('student.schedule.show',$project_schedule->id)}}"
                                           class="btn btn-info btn-circle"
                                           data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil"
                                                                                               aria-hidden="true"></i></a>
                                        <a onclick="return deleteTask('{{$project_schedule->id}}')"
                                           class="btn btn-danger btn-circle"
                                           data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-times"
                                                                                               aria-hidden="true"></i></a>
                                        <form action="{{route('student.schedule.delete', $project_schedule->id)}}" style="visibility: hidden;" id="{{$project_schedule->id}}" method='POST' >
                                            {{csrf_field()}}

                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center"><h4>You have not uploaded any task at the moment</h4></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                                class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Add New Task</h3>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" action="{{route('student.schedules.save')}}"
                          method="POST">
                        {{csrf_field()}}
                        @if(Session::has('message'))
                            <p class="alert alert-danger">{{ Session::get('message') }}</p>
                        @endif
                        @if(!empty($warning))
                            <p class="alert alert-danger">{{ $warning }}</p>
                        @endif
                        <div class="form-group">
                            <label for="old_password" class="col-sm-12 control-label" style="text-align: left;"><b>Task
                                    Name</b></label>
                            <div class="col-sm-12">
                                <div class="fg-line{{ $errors->has('task_name') ? ' has-error' : '' }}">
                                    <input type="text" class="form-control input-sm" id="task_name"
                                           name="task_name" required>
                                    @if ($errors->has('task_name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('task_name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start" class="col-sm-12 control-label" style="text-align: left;"><b>Start
                                    Date</b></label>
                            <div class="col-sm-12">
                                <div class="fg-line{{ $errors->has('start') ? ' has-error' : '' }}">
                                    <input type="date" class="form-control input-sm" id="start"
                                           name="start" required>
                                    @if ($errors->has('start'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('start') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="duration" class="col-sm-12 control-label"
                                   style="text-align: left;"><b>Duration /hour</b></label>
                            <div class="col-sm-12">
                                <div class="fg-line{{ $errors->has('duration') ? ' has-error' : '' }}">
                                    <input type="number" class="form-control input-sm" id="duration"
                                           name="duration" required>
                                    @if ($errors->has('duration'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('duration') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- @if(count($schedules))

                            <div class="form-group">
                                <label for="duration" class="col-sm-12 control-label" style="text-align: left;"><b>Dependency</b></label>
                                <div class="col-sm-12">
                                    <div class="fg-line{{ $errors->has('dependency') ? ' has-error' : '' }}">
                                        <select class="form-control selectpicker" multiple
                                                data-max-options="6" name="dependency[]">

                                            @foreach($schedules as $schedule)
                                                <option value="{{$schedule->id}}">{{$schedule->task_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('dependency'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('dependency') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    @endif -->

                </div>

                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary btn-hover-green" data-action="save"
                                    role="button">Submit
                            </button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close
                            </button>
                        </div>
                    </div>
                </div>
                </form>
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
    <script type="text/javascript">
        function newTask() {
            $('#addTask').modal('show')

        }
        function deleteTask(id) {
            //alert(id);
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Task!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete !",
                closeOnConfirm: false
            }, function(isConfirm){

                if (isConfirm) {

                    document.getElementById(id).submit();

                }
            });
        }
    </script>
@endpush