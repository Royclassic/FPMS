@extends('layouts.client-app')

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
        .lgi-attrs li.lgi-pending{
            border-color: #FF9800!important;
            color:#FF9800 !important;
        }
        .lgi-attrs li.lgi-completion{
            border-color: #03A9F4!important;
            color:#03A9F4 !important;
        }
        .
        .action-header{padding:25px 30px;line-height:100%;position:relative;z-index:1;min-height:65px;background-color:#F7F7F7}

    </style>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12" >
            <div class="white-box">
                <div class="card">

                    <div class="card-header">
                        <h2>Milestone
                            <small>Suggest tasks and milestones for various checkpoints</small>
                        </h2>
                    </div>
                    @if($now>$project_end)
                        <div class="alert alert-danger">
                            <p>Your previously assigned task has hit its deadline, please contact your supervisor for an extension to be able to submit your next milestone</p>
                        </div>
                        <div class="card-body card-padding">
                            <div class="list-group lg-odd-black">
                                <div class="action-header clearfix">
                                    <div class="ah-label hidden-xs">Progress Logs</div>
                                    <ul class="actions">
                                        Deadline :<span style="color: #FFC107">{{Carbon\Carbon::parse($project_end)->toDayDateTimeString()}}</span>
                                        <li class="dropdown">
                                            <a href="#" data-toggle="dropdown" aria-expanded="true">
                                                <i class="zmdi zmdi-sort"></i>
                                            </a>

                                        </li>
                                    </ul>
                                </div>
                                @if(Session::has('warning'))
                                    <p class="alert alert-warning">{{ Session::get('warning') }}</p>
                                @endif
                                @foreach($logs as $log)
                                    <div class="list-group-item media">
                                        <div class="checkbox pull-left">
                                            <label>
                                                <input type="checkbox" value="">
                                                <i class="input-helper"></i>
                                            </label>
                                        </div>

                                        <div class="pull-right">
                                            <div class="actions dropdown">
                                                <a href="" data-toggle="dropdown" aria-expanded="true">
                                                    <i class="zmdi zmdi-more-vert"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="#" onclick="return milestoneEdit('{{$log->id}}')">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" onclick="return deleteMilestone('{{$log->id}}')">Delete</a>
                                                    </li>
                                                    <form action="{{route('student.log.milestone.delete')}}" method="POST" id="{{$log->id}}" style="display: none;">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$log->id}}" >
                                                    </form>

                                                </ul>
                                            </div>
                                        </div>

                                        <div class="media-body">
                                            <div class="lgi-heading" style="overflow: auto;">{{$log->milestone}}</div>
                                            <small class="lgi-text"><b>Supervisor additional :</b> {{$log->additional_tasks}}
                                            </small>
                                            @if($log->comments!==null)
                                                <div class="list-group-item media" style="background-color: inherit!important;">
                                                    <div style="padding-left: 15px;">
                                                    </div>
                                                    <div class="pull-left">
                                                        @if(Auth::user()->student->supervisor->user->image==!null)
                                                            <img class="lgi-img"
                                                                 src="{{url('profile/'.Auth::user()->student->supervisor->user->image)}}"
                                                                 alt="">
                                                        @else
                                                            <img class="lgi-img" src="{{URL::to('default-profile.jpg')}}" alt="">
                                                        @endif
                                                    </div>

                                                    <div class="media-body">
                                                        <div class="lgi-heading">{{Auth::user()->student->supervisor->user->name}}</div>
                                                        <small class="lg-hide-items">{{$log->comments}}</small>
                                                    </div>
                                                </div>
                                            @endif
                                            <ul class="lgi-attrs">
                                                <li class="f-500">Date Created: {{$log->created_at->toDayDateTimeString()}}</li>
                                                @if($log->approved==1)
                                                    <li class="f-500">Approved: Yes</li>
                                                @elseif($log->approved==0)
                                                    <li class="f-500" style="color: yellow!important">Approved: Pending</li>
                                                @endif
                                                <li class="f-500">Assessed on : {{$log->updated_at->toDayDateTimeString()}} </li>
                                            </ul>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @else
                        <div class="card-body card-padding">
                            <div class="list-group lg-odd-black">
                                <div class="action-header clearfix">
                                    <div class="ah-label hidden-xs">Progress Logs</div>

                                    {{--<div class="ah-search">--}}
                                        {{--<input type="text" placeholder="Start typing..." class="ahs-input">--}}

                                        {{--<i class="ahs-close" data-ma-action="action-header-close">&times;</i>--}}

                                    {{--</div>--}}

                                    <ul class="actions">
                                        Deadline :<span style="color: #FFC107">{{Carbon\Carbon::parse($project_end)->toDayDateTimeString()}}</span>
                                        <!-- <a href="{{route('student.logs.print', $user->student->id)}}" style="color: darkgreen; font-size: 24px">
                                            <i style="color: darkgreen; font-size: 30px" class="zmdi zmdi-local-printshop"></i>
                                        </a> -->
                                    </ul>
                                </div>
                                @if(Session::has('warning'))
                                    <p class="alert alert-warning">{{ Session::get('warning') }}</p>
                                @endif
                                @foreach($logs as $log)
                                    <div class="list-group-item media">
                                        <div class="checkbox pull-left">
                                            <label>
                                                <input type="checkbox" value="">
                                                <i class="input-helper"></i>
                                            </label>
                                        </div>

                                        <div class="pull-right">
                                            <div class="actions dropdown">
                                                <a href="" data-toggle="dropdown" aria-expanded="true">
                                                    <i class="zmdi zmdi-more-vert"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="#" onclick="return milestoneEdit('{{$log->id}}')">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" onclick="return deleteMilestone('{{$log->id}}')">Delete</a>
                                                    </li>
                                                    <form action="{{route('student.log.milestone.delete')}}" method="POST" id="{{$log->id}}" style="display: none;">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$log->id}}" >
                                                    </form>

                                                </ul>
                                            </div>
                                        </div>

                                        <div class="media-body">
                                            <div class="lgi-heading" style="overflow: auto;">{{$log->milestone}}</div>
                                            <small class="lgi-text"><b>Supervisor additional :</b> {{$log->additional_tasks}}
                                            </small>
                                            @if($log->comments!==null)
                                                <div class="list-group-item media" style="background-color: inherit!important;">
                                                    <div style="padding-left: 15px;">
                                                    </div>
                                                    <div class="pull-left">
                                                        @if(Auth::user()->student->supervisor->user->image==!null)
                                                            <img class="lgi-img"
                                                                 src="{{url('profile/'.Auth::user()->student->supervisor->user->image)}}"
                                                                 alt="">
                                                        @else
                                                            <img class="lgi-img" src="{{url('default-profile.jpg')}}" alt="">
                                                        @endif
                                                    </div>

                                                    <div class="media-body">
                                                        <div class="lgi-heading">{{Auth::user()->student->supervisor->user->name}}</div>
                                                        <small class="lg-hide-items">{{$log->comments}}</small>
                                                    </div>
                                                </div>
                                            @endif
                                            <ul class="lgi-attrs">
                                                <li class="f-500">Date Created: {{$log->created_at->toDayDateTimeString()}}</li>
                                                @if($log->approved==1)
                                                    <li class="f-500">Approved: Yes</li>
                                                @elseif($log->approved==0)
                                                    <li class="lgi-pending f-500" >Approved: Pending</li>
                                                @endif
                                                <li class="f-500">Assessed on : {{$log->updated_at->toDayDateTimeString()}} </li>
                                            </ul>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                            <form class="form-horizontal" role="form" action="{{route('student.logs.save')}}" method="POST"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="password" class="col-sm-12 control-label" style="text-align: left;"><b>What is the next milestone that you will be working on?</b></label>
                                    <div class="col-sm-12">
                                        <div class="fg-line{{ $errors->has('milestone') ? ' has-error' : '' }}">
                                            <textarea class="form-control" name="milestone" id="sum" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-sm" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editTask" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Milestone</h4>
                </div>
                <div class="modal-body">
                    <!-- content goes here -->
                    <form action="{{route('student.log.milestone.update')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="milestone_id">
                        <div class="form-group">
                            <label for="password" class="col-sm-12 control-label" style="text-align: left;"><b>Milestone</b></label>
                            <div class="col-sm-12">
                                <div class="fg-line{{ $errors->has('milestone') ? ' has-error' : '' }}">
                                    <textarea class="form-control" name="milestone" id="sum" required></textarea>
                                </div>

                            </div>
                            <br><br>
                        </div>
                        <br>

                        <div class="modal-footer">

                            <button type="submit"   class="btn btn-primary btn-hover-green btn-sm pull-left" data-action="save" role="button" >Update</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>

                        </div>
                    </form>
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
    <script>
        $('.textarea_editor').wysihtml5();

    </script>
    <script type="text/javascript">

        function milestoneEdit(id) {
            swal({
                title: "Are you sure?",
                text: "You will have to wait for approval again!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Edit!",
                closeOnConfirm: true
            }, function (isConfirm) {

                if (isConfirm) {
                    var submiturl = "{{URL::to('student/project/milestone/edit')}}";
                    $.ajax({
                        url: submiturl + '/' + id,
                        type: 'GET',
                        data: '',
                        success: function (data) {
                            console.log(data)
                            $("input[name='milestone_id']").val(data.id);
                            $("textarea[name='milestone']").val(data.milestone);
                        },
                        error: function (xhr) {
                            console.log("xhr=" + xhr);

                        }

                    })
                    $('#editTask').modal('show')
                }
            });
        }
        function deleteMilestone(id) {
            swal({
                title: "Are you sure?",
                text: "You are about to delete this milestone!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                closeOnConfirm: false
            }, function (isConfirm) {

                if (isConfirm) {
                    document.getElementById(id).submit();
                }
            });


        }

    </script>
@endpush