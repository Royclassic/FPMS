@extends('layouts.member-app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-lock"></i> Change Password</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li class="active">Change Password</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/morrisjs/morris.css') }}"><!--Owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/owl.carousel/owl.carousel.min.css') }}"><!--Owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/owl.carousel/owl.theme.default.css') }}"><!--Owl carousel CSS -->
    <link rel="stylesheet" href="{{ URL::to('css/app_1.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/app_3.min.css') }}">
    <link href="{{URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

    <style>
        .col-in{
            padding: 0 20px !important;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="card">
                    <form class="form-horizontal" role="form" action="{{route('supervisor.changePassword')}}" method="POST">
                        {{csrf_field()}}
                        @if(Session::has('message'))
                            <p class="alert alert-danger">{{ Session::get('message') }}</p>
                        @endif
                        <div class="card-header">
                            <h2>Change Password
                                <!-- <small>Use Bootstrap's predefined grid classes to align labels and groups of form
                                    controls in a horizontal layout by adding '.form-horizontal' to the form. Doing
                                    so changes '.form-groups' to behave as grid rows, so no need for '.row'.
                                </small> -->
                            </h2>
                        </div>

                        <div class="card-body card-padding">
                            <div class="form-group" >
                                <label for="old_password" class="col-sm-2 control-label">Current Password</label>
                                <div class="col-sm-10">
                                    <div class="fg-line{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                        <input type="password" class="form-control input-sm" id="old_password"
                                               name="old_password" required>
                                        @if ($errors->has('old_password'))
                                            <span class="help-block">
			                                        <strong>{{ $errors->first('old_password') }}</strong>
			                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">New Password</label>
                                <div class="col-sm-10">

                                    <div class="fg-line{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input type="password" class="form-control input-sm" id="password"
                                               name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
				                                        <strong>{{ $errors->first('password') }}</strong>
				                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
                                <div class="col-sm-10">

                                    <div class="fg-line{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <input type="password" class="form-control input-sm" id="password_confirmation"
                                               name="password_confirmation">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
					                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
					                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-sm" type="submit">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection