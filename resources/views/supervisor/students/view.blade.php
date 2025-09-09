@extends('layouts.member-app')

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
                <li><a href="{{ route('supervisor.dashboard') }}">Home</a></li>
                <li class="active">{{ $pageTitle }}</li>
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

                <div class="table-responsive">
                    <table  class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="example" width="100%">
                        <thead>
                        <tr>

                            <th>Name</th>
                            <th>Admission</th>
                            <th>Course</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $key=>$student)
                            <tr>

                                <td>{{$student->user->name}}</td>
                                <td>{{$student->user->admission_staff_no}}</td>
                                <td>{{$student->user->course->course}}</td>
                                <td>{{$student->user->phone}}</td>
                                <td>{{$student->user->email}}</td>
                                <td>
                                    <a href="{{route('supervisor.students.profile', $student->user->id)}}">
                                        <button style="color: #00BCD4" type="button"  class="btn btn-default btn-circle " ><span class="zmdi zmdi-eye" ></span></button>
                                    </a>
                                </td>
                                <form action="#" style="visibility: hidden;" id="#" method='POST' >
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="#">
                                </form>



                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->

@endsection

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{URL::to('plugins/dataTables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{URL::to('plugins/dataTables/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::to('plugins/dataTables/responsive.bootstrap.min.js')}}"></script>
    <script>
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