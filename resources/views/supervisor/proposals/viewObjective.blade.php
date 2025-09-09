@extends('layouts.member-app')
@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-doc"></i> Objective Review</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('supervisor.dashboard') }}">Home</a></li>
                <li class="active">Objective Review</li>
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
    <div class="col-md-12" style="padding-left: 30px !important;">
        <div class="white-box">
            <div class="">
                <div class="t-view" data-tv-type="text">
                    <div class="tv-header media">
                        <a href="" class="tvh-user pull-left">
                            @if($student->image==null)
                                <img class="img-responsive" src="{{URL::to('default-profile-2.png')}}" alt="">
                             @else
                             <img class="img-responsive" src="{{URL::to('profile/'. $student->image)}}" alt="">
                            @endif
                        </a>
                        <div class="media-body p-t-5">
                            <strong class="d-block">{{$student->name}}</strong>
                            <small class="c-gray">{{$student->admission_staff_no}}</small>
                        </div>
                    </div>
                    <div class="tv-body">
                        <div class="clearfix"></div>

                        <div class="clearfix"></div>
                        <div class="pm-body clearfix">
                            <!-- <div class="pmb-block ">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-wrap-text m-r-10"></i>Research Questions</h2>
                                </div>
                                <div class="pmbb-body p-l-30">

                                    <div class="pmbb-view">
                                        <dl class="dl-horizontal">
                                            <dt>Questions</dt>
                                            <dd>{!!$objective->questions!!}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div> -->
                            <div class="pmb-block ">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-wrap-text m-r-10"></i>Research Objectives</h2>
                                </div>
                                <div class="pmbb-body p-l-30">

                                    <div class="pmbb-view">
                                        <dl class="dl-horizontal">
                                            <dt>Objectives</dt>
                                            <dd>{!!$objective->objectives!!}</dd>
                                        </dl>

                                        <dl class="dl-horizontal">
                                            <dt>Status</dt>
                                            @if($objective->status==0)
                                                <dd><button class="btn btn-warning btn-xs">Approval Pending</button></dd>
                                            @elseif($objective->status==2)
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
                            @forelse($objective->reviews as $review)
                                <li class="media">
                                    <a href="" class="tvh-user pull-left">
                                        @if($review->user->image==null)
                                            <img class="img-responsive" src="{{URL::to('default-profile-2.png')}}" alt="">
                                        @else
                                            <img class="img-responsive" src="{{URL::to('profile/'.$review->user->image)}}" alt="">
                                        @endif
                                    </a>
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
                                        <div class="m-t-10" style="color: #dd7b0b">No reviews for {{$student->name}} at the moment</div>
                                    </div>
                                </li>
                            @endforelse
                            <form action="{{route('supervisor.objective.review', $objective->id)}}" method="POST">
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
                    @if($objective->status==0)
                        <a href="{{route('supervisor.objective.approve', $objective->id)}}">
                            <button  class="btn btn-primary  btn-sm">Accept
                            </button>
                        </a>
                        <a href="{{route('supervisor.objective.disapprove', $objective->id)}}">
                            <button  class="btn btn-warning  btn-sm">Reject
                            </button>
                        </a>
                    @elseif($objective->status==1)
                        <a href="{{route('supervisor.objective.disapprove', $objective->id)}}">
                            <button  class="btn btn-warning  btn-sm">Reject Objectives
                            </button>
                        </a>
                    @elseif($objective->status==2)
                        <a href="{{route('supervisor.objective.approve', $objective->id)}}">
                            <button  class="btn btn-primary  btn-sm">Approve Objectives
                            </button>
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection