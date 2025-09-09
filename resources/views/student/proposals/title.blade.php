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
                <li><a href="{{ route('student.proposal.title') }}">{{ $pageTitle }}</a></li>
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

@if($proposal==null)
    <form class="form-horizontal" role="form" action="{{route('student.proposal.saveTitle')}}" method="POST">
        {{csrf_field()}}
        @if(Session::has('message'))
            <p class="alert alert-danger">{{ Session::get('message') }}</p>
        @endif
        @if(!empty($warning))
            <p class="alert alert-danger">{{ $warning }}</p>
        @endif

        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Submit Your Project Title and the following repective fields</div>

                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">What is the title of the project you are proposing? <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control {{ $errors->has('title') ? ' has-error' : '' }} " id="title"
                                                   name="title" required>
                                            @if ($errors->has('title'))
                                                <span class="help-block">
			                                        <strong>{{ $errors->first('title') }}</strong>
                                              </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">What broad field or subject area are you interested in? e.g Expert Systems in Education<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control {{ $errors->has('field') ? ' has-error' : '' }} " id="title"
                                                   name="field" required>
                                            @if ($errors->has('field'))
                                                <span class="help-block">
			                                        <strong>{{ $errors->first('field') }}</strong>
                                              </span>
                                            @endif
                                        </div>
                                    </div> -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label ">What Subareas are related to the broad field or subject area of your interest? In numbering. <span class="text-danger">*</span></label>
                                            <textarea class="textarea_editor form-control" rows="10" name="subareas"
                                                      id="subareas"></textarea>
                                            @if ($errors->has('subareas'))
                                                <span class="help-block">
			                                        <strong>{{ $errors->first('subareas') }}</strong>
                                              </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">What Subarea is of most interest to you? e.g Elearning <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control  {{ $errors->has('main_subarea') ? ' has-error' : '' }} " id="title"
                                                   name="main_subarea" required>
                                            @if ($errors->has('main_subarea'))
                                                <span class="help-block">
			                                        <strong>{{ $errors->first('main_subarea') }}</strong>
                                              </span>
                                            @endif
                                        </div>
                                    </div> -->
                                    <!--/span-->

                                </div>
                                <!--/row-->

                            </div>
                        </div>

                        <div class="panel-footer text-right">
                            <div class="btn-group dropup">
                                <button class="btn btn-success" type="submit">@lang('app.submit')</button>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <!-- .row -->
        </div>

    </form>
@else
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12" style="padding-left: 30px!important;">
            <div class="white-box">
                <div class="#">
                    @if(Session::has('message'))
                        <p class="alert alert-danger">{{ Session::get('message') }}</p>
                    @endif
                    <div class="t-view" data-tv-type="text">
                        <div class="tv-header media">
                            @if(Auth::user()->image==null)
                                <a href="" class="tvh-user pull-left">
                                    <img class="img-responsive" src="{{URL::to('default-profile-2.png')}}" alt="">
                                </a>
                            @else
                                <a href="" class="tvh-user pull-left">
                                    <img class="img-responsive" src="{{URL::to('profile/'. $user->image)}}" alt="">
                                </a>
                            @endif

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
                                        <h2><i class="zmdi zmdi-wrap-text m-r-10"></i>Proposal Title</h2>

                                    </div>
                                    <div class="pmbb-body p-l-30">

                                        <div class="pmbb-view">
                                            <!-- <dl class="dl-horizontal">
                                                <dt>Main Field</dt>
                                                <dd>{{$proposal->field}}</dd>
                                            </dl> -->
                                            <dl class="dl-horizontal">
                                                <dt>Sub-areas</dt>
                                                <dd>{!! $proposal->subareas !!}</dd>
                                            </dl>
                                            <!-- <dl class="dl-horizontal">
                                                <dt>Main Area of Intrest</dt>
                                                <dd>{!! $proposal->main_subarea !!}</dd>
                                            </dl> -->
                                            <dl class="dl-horizontal">
                                                <dt>Title</dt>
                                                <dd>{!! $proposal->title->title !!}</dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt>Status</dt>
                                                @if($proposal->title->status==0)
                                                    <dd><button class="btn btn-warning btn-xs">Approval Pending</button></dd>
                                                @elseif($proposal->title->status==2)
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
                            <a class="tvc-more" href=""><i class="zmdi zmdi-mode-comment"></i> Supervisor Reviews</a>
                        </div>

                        <div class="tv-comments">
                            <ul class="tvc-lists">
                                @forelse($proposal->title->reviews as $review)
                                    <li class="media">
                                        @if($review->user->image==null)
                                            <a href="" class="tvh-user pull-left">
                                                <img class="img-responsive" src="{{URL::to('default-profile-2.png')}}" alt="">
                                            </a>
                                        @else
                                            <a href="" class="tvh-user pull-left">
                                                <img class="img-responsive" src="{{URL::to('profile/'.$review->user->image)}}" alt="">
                                            </a>
                                        @endif
                                        <div class="media-body">
                                            <strong class="d-block">{{$review->user->name}}</strong>
                                            <small class="c-gray">{{$review->created_at->toDayDateTimeString()}}</small>

                                            <div class="m-t-10">{{$review->review}}
                                            </div>

                                        </div>
                                    </li>
                                @empty
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="m-t-10" style="color: #dd7b0b">No reviews for {{$user->name}} at the moment</div>
                                        </div>
                                    </li>
                                @endforelse
                                <form action="{{route('student.title.reply')}}" method="POST">
                                    {{csrf_field()}}
                                    <li class="p-20">
                                        <div class="fg-line">
                                            <textarea class="form-control auto-size" placeholder="Write a reply..." name="review"></textarea>
                                        </div>

                                        <button class="m-t-15 btn btn-primary btn-sm" type="submit">Reply</button>
                                    </li>
                                </form>

                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class=" row text-center" >
                        <button type="submit" onclick="return titleEdit('{{$proposal->title->id}}')"
                                class="btn btn-primary  btn-sm">Change Title
                        </button>
                    </div>

                    <form style="visibility: hidden" method="POST" action="{{route('student.title.edit',$proposal->title->id)}}" id="{{$proposal->title->id}}">
                        {{csrf_field()}}
                    </form>
                </div>
            </div>

        </div>
    </div>

         <div class="modal fade" id="editTitle" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="lineModalLabel">Edit Title</h3>
                    </div>
                    <div class="modal-body">

                        <!-- content goes here -->
                        <form id="updateform" method="POST" action="{{route('student.title.edit')}}">
                            {{csrf_field()}}
                            <div class="form-group" >
                                <label for="title" class="col-sm-12 control-label" style="text-align: left;"><b>What is the title of the project you are proposing?</b></label>
                                <div class="col-sm-12">
                                    <div class="fg-line">
                                        <input type="text" class="form-control input-sm"
                                               name="title" required>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="field" class="col-sm-12 control-label" style="text-align: left;"><b>What broad field or subject area are you interested in?</b></label>
                                <div class="col-sm-12">
                                    <div class="fg-line">
                                        <input type="text" class="form-control" name="field"  required>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label for="subarea" class="col-sm-12 control-label" style="text-align: left;"><b>What Subareas are related to the broad field or subject area of your interest? In numbering.</b></label>
                                <div class="col-sm-12">
                                    <div class="fg-line">
                                        <textarea class="form-control " name="subareas"  required></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="password" class="col-sm-12 control-label" style="text-align: left;"><b>What Subarea is of most interest to you?</b></label>
                                <div class="col-sm-12">
                                    <div class="fg-line">
                                        <input type="text" class="form-control" name="main_subarea"  required>
                                    </div>
                                </div>
                            </div> -->
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
    <script>
        $('.textarea_editor').wysihtml5();

    </script>
    <script type="text/javascript">

    function titleEdit(id) {
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
                var submiturl="{{URL::to('student/proposal/title/edit')}}";
                $.ajax({
                    url:submiturl+ '/' +id,
                    type:'GET',
                    data:'',
                    success:function (data) {
                        console.log(data)
                        $("input[name='title']").val(data.title);
                        $("input[name='field']").val(data.field);
                        $("input[name='main_subarea']").val(data.main_subarea)
                        $("textarea[name='subareas']").summernote('code',data.subareas);
                    },
                    error: function (xhr) {
                        console.log("xhr=" + xhr);

                    }

                })
                $('#editTitle').modal('show')
            }
        });
        //document.getElementById(id).submit();


    }
</script>
@endpush