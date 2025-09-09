@extends('layouts.client-app')
@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="ui-icon-person"></i> Supervisor Profile</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('student.dashboard.index') }}">@lang('app.menu.home')</a></li>
                <li><a class="active">Supervisor Profile</a></li>
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
        #profile-main{
            min-height: 470px;
            max-height: inherit;
        }
        #clearfix{
            min-width: 470px;
        }

        #center{
            min-height: 400px;
            max-height: 400px;
            max-width: 400px;
            min-width: 400px;
        }
        #pic{
            min-height: 300px;
            max-height: 300px;
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
    <div class="container container-alt ">

        <div class="block-header">
            <h2>{{$supervisor->name}}
                <small> {{$supervisor->admission_staff_no}} </small>
            </h2>
        </div>

        <div class="card col-md-3 profile" id="profile-main" >
            <div class="pm-overview c-overflow">
                <div class="pmo-pic" >
                    <div class="p-relative"  >
                        <a href="#">
                            @if($supervisor->image===null)
                                    <img src="{{url('default-profile.jpg')}}" alt="">
                            @else
                                <img id="pic" class="img-responsive" src="{{URL::to('/profile/'. $supervisor->image)}}" alt="">
                            @endif
                        </a>

                    </div>

                </div>
            </div>

        </div>
        <div class="pm-body clearfix col-md-9" id="clearfix">
            <div class="container container-alt">
                <div class="card" id="profile-main" >

                    <div class="pm-body clearfix">
                        <div class="pmb-block ">
                            <div class="pmbb-header">
                                <h2><i class="zmdi zmdi-account m-r-10"></i> Basic Information</h2>

                            </div>
                            <div class="pmbb-body p-l-30">

                                <div class="pmbb-view">
                                    <dl class="dl-horizontal">
                                        <dt>Full Names</dt>
                                        <dd>{{$supervisor->name}}</dd>
                                    </dl>

                                    <dl class="dl-horizontal">
                                        <dt>Gender</dt>
                                        <dd>{{$supervisor->gender}}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="pmb-block">
                            <div class="pmbb-header">
                                <h2><i class="zmdi zmdi-phone m-r-10"></i> Contact Information</h2>

                            </div>
                            <div class="pmbb-body p-l-30">
                                <div class="pmbb-view">
                                    <dl class="dl-horizontal">
                                        <dt>Mobile Phone</dt>
                                        <dd>{{$supervisor->phone}}</dd>
                                    </dl>
                                    <dl class="dl-horizontal">
                                        <dt>Email Address</dt>
                                        <dd>{{$supervisor->email}}</dd>
                                    </dl>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@endsection
