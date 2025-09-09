@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-layers"></i> Proposals</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('supervisor.dashboard') }}">Home</a></li>
                <li class="active">Proposals</li>
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
                        <h2>Final Students Proposals
                            <br>
                            <small><h6>Students who have finished their proposals and given green light by their supervisors</h6>
                            </small>
                        </h2>
                    </div>
                    <div class="card-body card-padding">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="example" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student</th>
                                    <th>Admission</th>
                                    <th>Field</th>
                                    <th>Title</th>
                                    <th>Proposal</th>
                                    <td>Supervisor</td>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($proposals as $key=>$proposal)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <td>{{$proposal->student->user->name}}</td>
                                        <td>{{$proposal->student->user->admission_staff_no}}</td>
                                        <td>{!! $proposal->field !!}</td>
                                        <td>{{$proposal->title->title}}</td>
                                        <td>{{$proposal->file}}</td>
                                        <td>{{$proposal->student->supervisor->user->name}}</td>
                                        <td>
                                            <a href="{{route('admin.proposals.view', $proposal->id)}}">
                                                <button  type="button"  class="btn btn-primary btn-xs " ><span class="zmdi zmdi-check-all" ></span> View</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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