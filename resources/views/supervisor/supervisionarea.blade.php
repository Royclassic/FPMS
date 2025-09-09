@extends('layouts.member-app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <h4 class="page-title"><i class="icon-doc"></i> Proposals Assessments</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-7 col-sm-7 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('supervisor.dashboard') }}">Home</a></li>
                <li class="active">Assessments</li>
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
    <link rel="stylesheet" href="{{ URL::to('css/app_3.min.css') }}">
    <link href="{{URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="card">
                <div class="card-header">
                    <h2>Supervision area<small>Add your area of specialization for project supervision</small></h2>
                    @if(Session::has('message'))
                        <p class="alert alert-danger">{{ Session::get('message') }}</p>
                    @endif
                </div>
                <div class="card-body card-padding">
                    <div class="btn-demo">
                        @if($areas!=null)
                            @foreach($areas as $area)
                                <button class="btn btn-default btn-icon-text">
                                    <i class="zmdi zmdi-star-outline"></i>
                                    {{$area->supervision_area}}
                                </button>
                            @endforeach
                        @endif
                        <button class="btn btn-success btn-icon-text" id="location"><i class="zmdi zmdi-plus"></i>Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    <div class="modal fade" id="addSkill" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Supervision Area</h4>
                </div>
                <div class="modal-body">
                    <!-- content goes here -->
                    <form action="{{route('supervisor.supervision.add')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label for="status">Area</label>
                            <input type="text" name="supervision_area" class="form-control" required id="skill">
                        </div>



                        <div class="modal-footer">

                            <button type="submit"   class="btn btn-primary btn-hover-green btn-sm pull-left" data-action="save" role="button" >Add</button>

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
    <script src="{{URL::to('plugins/editor.js')}}"></script>
    <script type="text/javascript">
        $('#location').on('click', function (e) {
            e.preventDefault();
            $('#skill').val(' ')
            $('#addSkill').modal('show')
        })
    </script>
@endpush
