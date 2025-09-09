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
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="row row-in">
                    <div class="col-lg-3 col-sm-6 row-in-br">
                        <div class="col-in row">
                            <h3 class="box-title">@lang('modules.dashboard.totalProjects')</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-layers text-info"></i></li>
                                <li class="text-right"><span class="counter">1</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Project Supervisor</div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="steamline">
                                        @if($user->student->supervisor)
                                            <div class="sl-item">
                                                @if($user->student->supervisor->user->image==null)
                                                <div class="sl-left">
                                                  <img src="{{asset('default-profile.jpg')}}" alt="supervisor" height="30" width="30" class="img-circle">
                                                </div>
                                                @else
                                                <div class="sl-left">
                                                    <img src="{{asset('profile/'. $user->student->supervisor->user->image)}}" alt="supervisor" height="30" width="30" class="img-circle">
                                                </div>
                                                @endif
                                                <div class="sl-right">
                                                    <div class="m-l-40">
                                                        <a href="{{ route('student.supervisor.show') }}" class="text-success">{{ ucwords($user->student->supervisor->user->name) }}</a>
                                                        <span  class="sl-date">{{ $user->student->updated_at->diffForHumans() }}</span>
                                                        <p>Email : {{$user->student->supervisor->user->email}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                      @else
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
