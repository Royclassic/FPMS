@extends('layouts.member-app')
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
                <li><a href="{{ route('supervisor.dashboard') }}">Home</a></li>
                <li class="active">Documentations</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{asset('dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/plugins/dataTables/responsive.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/plugins/dataTables/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ URL::to('css/app_1.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/app_2.min.css') }}">
    <link href="{{URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    {{--<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">--}}
    <link href="{{asset('plugins/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
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
        .lgi-attrs li.lgi-completion{
            border-color: #03A9F4!important;
            color:#03A9F4 !important;
        }
        .action-header{padding:25px 30px;line-height:100%;position:relative;z-index:1;min-height:65px;background-color:#F7F7F7}
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="card">
                    @if(Session::has('message'))
                        <p class="alert alert-danger">{{ Session::get('message') }}</p>
                    @endif
                    <div class="card-header">
                        <h2>Documentations Chapters
                            <small>Approve and review student documentation chapters and final documentation </small>
                        </h2>
                    </div>

                    <div class="card-body card-padding">
                        <div class="list-group lg-odd-black">
                            <div class="action-header clearfix">
                                <div class="ah-label hidden-xs">Documentation Chapters for {{$doc->student->user->name}}</div>
                                <ul class="actions">
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown" aria-expanded="true">
                                            <i class="zmdi zmdi-sort"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            @include('supervisor.documentations.chapters.chapterone')
                            @include('supervisor.documentations.chapters.chaptertwo')
                            @include('supervisor.documentations.chapters.chapterthree')
                            @include('supervisor.documentations.chapters.final')
                        </div>
                        @if(!empty($warning))
                            <p class="alert alert-danger">{{ $warning }}</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('supervisor.documentations.modals.assessChapterOneModal')
    @include('supervisor.documentations.modals.editChapterOneModal')
    @include('supervisor.documentations.modals.assessChapterTwoModal')
    @include('supervisor.documentations.modals.editChapterTwoModal')
    @include('supervisor.documentations.modals.assessChapterThreeModal')
    @include('supervisor.documentations.modals.editChapterThreeModal')
    @include('supervisor.documentations.modals.assessFinalModal')
    @include('supervisor.documentations.modals.editFinalModal')

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
        function assessChapterOne(id) {
            $("input[name='chapter_one_id']").val(id);
            $('#assessChapterOne').modal('show');

        }
        function editChapterOneAssessment(id) {
            var submiturl = "{{URL::to('supervisor/project/doc/chapterOne/assessment/edit')}}";
            $.ajax({
                url: submiturl + '/' + id,
                type: 'GET',
                data: '',
                success: function (data) {
                    console.log(data)
                    $("input[name='chapter_one_id']").val(data.id);
                    $("textarea[name='comment']").val(data.comment);
                },
                error: function (xhr) {
                    console.log("xhr=" + xhr);
                }
            });
            $('#editChapterOneAssessment').modal('show')
        }
        function chapterOneDelete(id) {
            swal({
                title: "Are you sure?",
                text: "You are about to delete this Assessment!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                closeOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    document.getElementById(id).submit();
                }
            });

        }

        function assessChapterTwo(id) {
            $("input[name='chapter_two_id']").val(id);
            $('#assessChapterTwo').modal('show');

        }
        function editChapterTwoAssessment(id) {
            var submiturl = "{{URL::to('supervisor/project/doc/chapterTwo/assessment/edit')}}";
            $.ajax({
                url: submiturl + '/' + id,
                type: 'GET',
                data: '',
                success: function (data) {
                    console.log(data)
                    $("input[name='chapter_two_id']").val(data.id);
                    $("textarea[name='comment']").val(data.comment);
                },
                error: function (xhr) {
                    console.log("xhr=" + xhr);
                }
            });
            $('#editChapterTwoAssessment').modal('show')
        }
        function chapterTwoDelete(id) {
            swal({
                title: "Are you sure?",
                text: "You are about to delete this Assessment!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                closeOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    document.getElementById(id).submit();
                }
            });

        }

        function assessChapterThree(id) {
            $("input[name='chapter_three_id']").val(id);
            $('#assessChapterThree').modal('show');

        }
        function editChapterThreeAssessment(id) {
            var submiturl = "{{URL::to('supervisor/project/doc/chapterThree/assessment/edit')}}";
            $.ajax({
                url: submiturl + '/' + id,
                type: 'GET',
                data: '',
                success: function (data) {
                    console.log(data)
                    $("input[name='chapter_three_id']").val(data.id);
                    $("textarea[name='comment']").val(data.comment);
                },
                error: function (xhr) {
                    console.log("xhr=" + xhr);
                }
            });
            $('#editChapterThreeAssessment').modal('show')
        }
        function chapterThreeDelete(id) {
            swal({
                title: "Are you sure?",
                text: "You are about to delete this Assessment!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                closeOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    document.getElementById(id).submit();
                }
            });

        }

        function assessFinal(id) {
            $("input[name='documentation_id']").val(id);
            $('#assessFinal').modal('show');

        }
        function editFinalAssessment(id) {
            var submiturl = "{{URL::to('supervisor/project/doc/final/assessment/edit')}}";
            $.ajax({
                url: submiturl + '/' + id,
                type: 'GET',
                data: '',
                success: function (data) {
                    console.log(data)
                    $("input[name='documentation_id']").val(data.id);
                    $("textarea[name='comment']").val(data.comment);
                },
                error: function (xhr) {
                    console.log("xhr=" + xhr);
                }
            });
            $('#editFinalAssessment').modal('show')
        }
        function finalDelete(id) {
            swal({
                title: "Are you sure?",
                text: "You are about to delete this Assessment!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                closeOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    document.getElementById(id).submit();
                }
            });

        }
    </script>
@endpush