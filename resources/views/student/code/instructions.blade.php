@extends('layouts.client-app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> Overview</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('student.dashboard.index') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('student.files.index') }}">Files</a></li>
                <li class="active">Overview</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/icheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/multiselect/css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section>
                <div class="sttabs tabs-style-line">
                    <div class="white-box">
                        <nav>
                            <ul>
                                <li class="tab-current"><a  href="{{route('student.files.overview')}}"><span>Overview</span></a>
                                </li>
                                <li ><a href="{{route('student.files.index')}}"><span>Codes</span></a> </li>>
                            </ul>
                        </nav>
                    </div>
                    <div class="content-wrap">
                        <section id="section-line-1" class="show">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white-box">
                                        <h3 class="b-b"> <span
                                                    class="font-bold">{{ ucwords($proposal->title->title) }}</span>
                                        </h3>

                                        <div>
                                            <p>Upload your project files in this section, files can be uploaded individually or as zipped documents</p>
                                            <p>Make sure you also project manual and installation instructions</p>
                                            <p>Database connections with credentials should also be specified</p>

                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">

                                        {{-- client details --}}
                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Supervisor</div>
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                           <dl>
                                                                    <dt>Name</dt>
                                                                    <dd class="m-b-10">{{ $proposal->student->supervisor->user->name}}</dd>

                                                           </dl>
                                                            <dl>
                                                                <dt>Email</dt>
                                                                <dd class="m-b-10">{{ $proposal->student->supervisor->user->email }}</dd>
                                                            </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Proposal</div>
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <dl>
                                                            <dt>Field</dt>
                                                            <dd class="m-b-10">{{ $proposal->field}}</dd>

                                                        </dl>
                                                        <dl>
                                                            <dt>Area</dt>
                                                            <dd class="m-b-10">{{ $proposal->main_subarea }}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Status</div>
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <dl>
                                                            <dt>Proposed on</dt>
                                                            <dd class="m-b-10">{{ Carbon\Carbon::parse($proposal->created_on)->toDayDateTimeString()}}</dd>

                                                        </dl>
                                                        <dl>
                                                            <dt>Status</dt>
                                                            @if($proposal->status==1)
                                                            <dd class="m-b-10">Approved</dd>
                                                            @else
                                                             <dd class="m-b-10">Pending</dd>
                                                            @endif
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div><!-- /content -->
                </div><!-- /tabs -->
            </section>
        </div>


    </div>
    <!-- .row -->

@endsection

@push('footer-script')
    <script src="{{ asset('js/cbpFWTabs.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush