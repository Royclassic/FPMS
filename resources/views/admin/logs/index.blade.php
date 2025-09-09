@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-clock"></i> Logs</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="active">Logs</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{asset('dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/plugins/dataTables/responsive.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/plugins/dataTables/buttons.dataTables.min.css')}}">
    <link href="{{URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="card">
                    <div class="card-header">
                        <h2>Project Logs
                            <small><h6>All students project logs and their supervisors</h6>
                            </small>
                        </h2>
                    </div>
                    <div class="card-body card-padding">
                        <table  class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="example" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Admission</th>
                                <th>Field</th>
                                <th>Title</th>
                                <th>Supervisor</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $key=>$student)
                                @if($student->proposal!==null)
                                    @if($student->logs->toArray()!==[])
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$student->user->name}}</td>
                                            <td>{{$student->user->admission_staff_no}}</td>
                                            <td>{!! $student->proposal->field !!}</td>
                                            <td>{{$student->proposal->title->title}}</td>
                                            <td>{{$student->supervisor->user->name}}</td>
                                            <td>
                                                <a href="{{route('admin.logs.view', $student->id)}}">
                                                    <button  type="button"  class="btn btn-success btn-xs " ><span class="zmdi zmdi-eye" ></span> Logs</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('footer-script')
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{URL::to('plugins/dataTables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{URL::to('plugins/dataTables/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::to('plugins/dataTables/responsive.bootstrap.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('#example').DataTable( {
                columnDefs: [ {
                    targets: [ 0 ],
                    orderData: [ 0, 1 ]
                }, {
                    targets: [ 1 ],
                    orderData: [ 1, 0 ]
                }, {
                    targets: [ ],
                    orderData: [ 4, 0 ]
                } ]
            } );
        } );

    </script>
@endpush