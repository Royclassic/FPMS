@extends('layouts.member-app')

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
                <li><a href="{{ route('supervisor.dashboard') }}">Home</a></li>
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
    {{--<link rel="stylesheet" href="{{ URL::to('css/app_1.min.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ URL::to('css/app_2.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link href="{{asset('plugins/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endpush
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table  class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="example" width="100%">
                        <thead>
                        <tr>
                            <th>Student</th>
                            <th>Admission</th>
                            <th>Field</th>
                            <th>Title</th>
                            <th>Deadline</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $key=>$student)
                            @if($student->proposal!==null && $student->proposal->title!==null)
                                @if($student->proposal->completed==1)
                                    @if($student->logs->toArray()!==[])
                                        <tr>
                                            <td>{{$student->user->name}}</td>
                                            <td>{{$student->user->admission_staff_no}}</td>
                                            <td>{!! $student->proposal->field !!}</td>
                                            <td>{{$student->proposal->title->title}}</td>
                                            @if($student->proposal->deadline==null)
                                                <td><button class="btn btn-success btn-xs" onclick="return addDeadline('{{$student->proposal->id}}')">Click to set deadline</button></td>
                                            @elseif($student->proposal->deadline!==null)
                                                <td>{{Carbon\Carbon::parse($student->proposal->deadline)->format('d-m-Y')}} <button onclick="return addDeadline('{{$student->proposal->id}}')"   class="btn btn-success btn-xs">Edit</button></td>
                                            @endif
                                            <td>
                                                <a href="{{route('supervisor.project.log.view', $student->id)}}">
                                                    <button  type="button"  class="btn btn-success btn-xs " ><span class="zmdi zmdi-eye" ></span> Logs</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->
    <div class="modal fade" id="deadlineModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Add Deadline for Project Log</h3>
                </div>
                <div class="modal-body">

                    <!-- content goes here -->
                    <form id="updateform" method="POST" action="{{route('supervisor.project.deadline')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="id" >
                        <div class="form-group">
                            <label for="start" class="col-sm-3 control-label">Deadline</label>
                            <fieldset class="col-sm-9">
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-9 xdisplay_inputx form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left"  id="deadlineInput" placeholder="Click here..." name="deadline" onmousedown="return dateDeadline()" aria-describedby="inputSuccess2Status">
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group" aria-label="group button">

                        <div class="btn-group" role="group">
                            <button type="submit"   class="btn btn-primary btn-hover-green" data-action="save" role="button">Update</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('footer-script')
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{URL::to('plugins/dataTables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{URL::to('plugins/dataTables/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::to('plugins/dataTables/responsive.bootstrap.min.js')}}"></script>
    <script src="{{URL::to('plugins/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
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
        function dateDeadline() {
            $('#deadlineInput').datetimepicker({
                format: 'YYYY-MM-DD h:mm A'
            });
        }
        function  addDeadline(id) {
            $("input[name='id']").val(id);
            $('#deadlineModal').modal('show');
        }

    </script>

@endpush
