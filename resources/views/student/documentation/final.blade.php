@extends('layouts.client-app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-docs"></i> Documentations</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('student.dashboard.index') }}">@lang('app.menu.home')</a></li>
                <li><a class="active">Final</a></li>
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
    @if($documentation->final_documentation==null)
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="card">
                        <form class="form-horizontal" role="form" action="{{route('student.final.save')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @if(Session::has('message'))
                                <p class="alert alert-danger">{{ Session::get('message') }}</p>
                            @endif
                            <div class="card-header">
                                <h2>Documentation Upload
                                </h2>
                            </div>

                            <div class="card-body card-padding">
                                @if(!empty($warning))
                                    <p class="alert alert-danger">{{ $warning }}</p>
                                @endif
                                <div class="form-group">
                                    <label for="password" class="col-sm-12 control-label" style="text-align: left;">
                                        <b>Upload your Final Documentation report Only as pdf file</b>
                                    </label>
                                    <div class="col-sm-12">
                                        <div class="fg-line{{ $errors->has('final_documentation') ? ' has-error' : '' }}">
                                            <input type="file" class="form-control" name="final_documentation"   required>
                                            @if ($errors->has('final_documentation'))
                                                <span class="help-block">
                                            <strong style="color: #dc3545;">{{ $errors->first('final_documentation') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-sm" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12" style="padding-left: 30px!important;">
                <div class="white-box">
                    <div class="">
                        @if(Session::has('message'))
                            <p class="alert alert-danger">{{ Session::get('message') }}</p>
                        @endif
                        <div class="t-view" data-tv-type="text">
                            <div class="tv-header media">
                                <a href="" class="tvh-user pull-left">
                                    @if($user->image==null)
                                        <img class="img-responsive" src="{{URL::to('default-profile.jpg')}}" alt="">
                                    @else
                                        <img class="img-responsive" src="{{URL::to('profile/'. $user->image)}}" alt="">
                                    @endif
                                </a>
                                <div class="media-body p-t-5">
                                    <strong class="d-block">{{$user->name}}</strong>
                                    <small class="c-gray">{{$user->admission_staff_no}}</small>
                                </div>
                            </div>
                            <div class="tv-body">
                                <div class="clearfix"></div>

                                <div class="clearfix"></div>
                                <div class="pm-body clearfix">
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
                                                    <dt>Documentation</dt>
                                                    <dd>{{$documentation->final_documentation}} &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="{{URL::to('documentations/'.$user->email.'/'.$documentation->final_documentation)}}" target="_blank">
                                                            <button class="btn btn-success btn-xs"><i class="zmdi zmdi-eye"></i> View</button>
                                                        </a>
                                                    </dd>
                                                </dl>

                                                <dl class="dl-horizontal">
                                                    <dt>Status</dt>
                                                    @if($documentation->status==0)
                                                        <dd><button class="btn btn-warning btn-xs">Approval Pending</button></dd>
                                                    @elseif($documentation->status==2)
                                                        <dd><button class="btn btn-danger btn-xs">Denied Approval</button></dd>
                                                    @else
                                                        <dd><button class="btn btn-success btn-xs">Approved</button></dd>
                                                    @endif
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <a class="tvc-more" href="#"><i class="zmdi zmdi-mode-comment"></i> Supervisor Comments</a>
                            </div>
                            <div class="tv-comments">
                                <ul class="tvc-lists">
                                    @if($documentation->comment!==null)
                                        <li class="media">
                                            <a href="" class="tvh-user pull-left">
                                                @if($documentation->student->supervisor->user->image!==null)
                                                    <img class="img-responsive" src="{{URL::to('profile/'.Auth::user()->student->supervisor->user->image)}}" alt="">
                                                @else
                                                    <img class="lgi-img" src="{{URL::to('default-profile.jpg')}}" alt="">
                                                @endif
                                            </a>
                                            <div class="media-body">
                                                <strong class="d-block">{{Auth::user()->student->supervisor->user->name}}</strong>
                                                <small class="c-gray">{{$documentation->updated_at->toDayDateTimeString()}}</small>

                                                <div class="m-t-10">{{$documentation->comment}}
                                                </div>
                                                <div class="clearfix"></div>
                                                <ul class="tvb-stats">
                                                    @if($documentation->completion==1)
                                                        <li class="tvbs-comments"> Fully Completed</li>
                                                    @elseif($documentation->completion==2)
                                                        <li class="tvbs-likes">Partially Completed</li>
                                                    @elseif($documentation->completion==3)
                                                        <li class="tvbs-views">Not to standards</li>
                                                    @endif
                                                </ul>

                                            </div>
                                        </li>
                                    @else
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="m-t-10" style="color: #dd7b0b">Your final document has not been assessed at the moment</div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class=" row text-center" >
                            <button type="submit"
                                    class="btn btn-primary  btn-sm" onclick="return problemEdit()">Edit Documentation
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editProblem" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="lineModalLabel">Edit Final Documentation</h3>
                    </div>
                    <div class="modal-body">

                        <!-- content goes here -->
                        <form id="updateform" method="POST" action="{{route('student.final.save')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="password" class="col-sm-12 control-label" style="text-align: left;">
                                    <b>Upload your final Project Documentation. Only as pdf file</b>
                                </label>
                                <div class="col-sm-12">
                                    <div class="fg-line{{ $errors->has('final_documentation') ? ' has-error' : '' }}">
                                        <input type="file" class="form-control" name="final_documentation" id="sum"  required>
                                        <br><br>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                            <div class="btn-group" role="group">
                                <button type="submit"   class="btn btn-primary btn-hover-green" data-action="save" role="button">Update</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('footer-script')
    <script src="{{ asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/html5-editor/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{URL::to('summernote/dist/summernote.js')}}"></script>
    <script src="{{URL::to('plugins/editor.js')}}"></script>

    <script type="text/javascript">

        function problemEdit(id) {
            swal({
                title: "Are you sure?",
                text: "You will have to re-propose again!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Edit!",
                closeOnConfirm: true
            }, function(isConfirm){

                if (isConfirm) {
                    var submiturl="{{URL::to('student/proposal/problem/edit')}}";
                    $.ajax({
                        url:submiturl+ '/' +id,
                        type:'GET',
                        data:'',
                        success:function (data) {
                            console.log(data)
                            $("textarea[name='problem']").summernote('code',data.problem);
                        },
                        error: function (xhr) {
                            console.log("xhr=" + xhr);

                        }

                    })
                    $('#editProblem').modal('show')
                }
            });
            //document.getElementById(id).submit();


        }
    </script>
@endpush
@section('scripts')

@endsection