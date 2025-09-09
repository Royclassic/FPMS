@extends('layouts.member-app')
@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-doc"></i> Title Review</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('supervisor.dashboard') }}">Home</a></li>
                <li class="active">Title Review</li>
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
    <style type="text/css">
        .pmbb-header{
            margin-bottom:25px;
            position:relative;

        }
        .pmbb-header h2{
            margin:0;
            font-weight:100;
            font-size:20px;
        }
        #f-menu{
            display: inline-block;

            padding-left: 0;
            margin-left: -5px;
            margin-top: 5px;
            list-style: none;
        }
        #f-menu li{
            display: inline-block;
            padding-left: 5px;
            padding-right: 5px;

        }
    </style>
<div class="row">
   <div class="col-md-12" style="padding-left: 30px !important;">
       <div class="white-box">
           <div class="t-view" data-tv-type="text">
               <div class="tv-header media">
                   @if($student->image==null)
                       <a href="" class="tvh-user pull-left">
                           <img class="img-responsive" src="{{URL::to('default-profile-2.png')}}" alt="">
                       </a>
                   @else
                       <a href="" class="tvh-user pull-left">
                           <img class="img-responsive" src="{{URL::to('profile/'. $student->image)}}" alt="">
                       </a>
                   @endif
                   <div class="media-body p-t-5">
                       <strong class="d-block">{{$student->name}}</strong>
                       <small class="c-gray">{{$student->admission_staff_no}}</small>
                   </div>
               </div>
               <div class="tv-body">
                   <div class="clearfix"></div>

                   <div class="clearfix"></div>
                   <div class="pm-body clearfix">
                       <div class="pmb-block ">
                           <div class="pmbb-header">
                               <h2><i class="zmdi zmdi-pin-account m-r-10"></i>Contact Information</h2>
                           </div>
                           <div class="pmbb-body p-l-30">

                               <div class="pmbb-view">
                                   <dl class="dl-horizontal">
                                       <dt>Mobile Phone</dt>
                                       <dd>{{$student->phone}}</dd>
                                   </dl>
                                   <dl class="dl-horizontal">
                                       <dt>Email Address</dt>
                                       <dd>{{$student->email}}</dd>
                                   </dl>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="pm-body clearfix">
                       <div class="pmb-block ">
                           <div class="pmbb-header">
                               <h2><i class="zmdi zmdi-wrap-text m-r-10"></i>Proposal Title</h2>
                           </div>
                           <div class="pmbb-body p-l-30">

                               <div class="pmbb-view">
                                   <!-- <dl class="dl-horizontal">
                                       <dt>Main Field</dt>
                                       <dd>{{$title->proposal->field}}</dd>
                                   </dl> -->
                                   <dl class="dl-horizontal">
                                       <dt>Sub-areas</dt>
                                       <dd>{!! $title->proposal->subareas !!}</dd>
                                   </dl>
                                   <!-- <dl class="dl-horizontal">
                                       <dt>Main Area of Intrest</dt>
                                       <dd>{!! $title->proposal->main_subarea !!}</dd>
                                   </dl> -->
                                   <dl class="dl-horizontal">
                                       <dt>Title</dt>
                                       <dd>{!! $title->title !!}</dd>
                                   </dl>
                                   <dl class="dl-horizontal">
                                       <dt>Status</dt>
                                       @if($title->status==0)
                                           <dd><button class="btn btn-warning btn-xs">Approval Pending</button></dd>
                                       @elseif($title->status==2)
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
                       @forelse($title->reviews as $review)
                           <li class="media">
                               <a href="" class="tvh-user pull-left">
                                   @if($review->user->image!==null)
                                       <img class="img-responsive" src="{{URL::to('profile/'.$review->user->image)}}" alt="">
                                   @else
                                       <img class="img-responsive" src="{{URL::to('default-profile-2.png')}}" alt="">
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
                                   <div class="m-t-10" style="color: #dd7b0b">No reviews for {{$user->name}} at the moment</div>
                               </div>
                           </li>
                       @endforelse
                       <form action="{{route('supervisor.title.review', $title->id)}}" method="POST">
                           {{csrf_field()}}
                           <li class="p-20">
                               <div class="fg-line">
                                   <textarea class="form-control auto-size" placeholder="Write a review..." name="review"></textarea>
                               </div>

                               <button class="m-t-15 btn btn-primary btn-sm" type="submit">Post</button>
                           </li>
                       </form>
                   </ul>
               </div>
           </div>
           <div class="clearfix"></div>
           <div class=" row text-center" >
               @if($title->status==0)
                   <a href="{{route('supervisor.title.approve', $title->id)}}">
                       <button  class="btn btn-primary  btn-sm">Approve Title
                       </button>
                   </a>
                   <a href="{{route('supervisor.title.disapprove', $title->id)}}">
                       <button  class="btn btn-warning  btn-sm">Reject Title
                       </button>
                   </a>
               @elseif($title->status==1)
                   <a href="{{route('supervisor.title.disapprove', $title->id)}}">
                       <button  class="btn btn-warning  btn-sm">Reject Title
                       </button>
                   </a>
               @elseif($title->status==2)
                   <a href="{{route('supervisor.title.approve', $title->id)}}">
                       <button  class="btn btn-primary  btn-sm">Approve Title
                       </button>
                   </a>
               @endif
           </div>


       </div>
   </div>
</div>

@endsection