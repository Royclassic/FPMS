@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-user"></i> Supervisor</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('admin.students.index') }}">Supervisor</a></li>
                <li class="active">Supervisor</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection


@section('content')
    <link href="{{URL::to('css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <div class="row">


        <div class="col-md-12">
            <div class="white-box">

                <div class="row">
                    <div class="col-xs-6 b-r"><strong>@lang('modules.employees.fullName')</strong> <br>
                        <p class="text-muted">{{ ucwords($client->name) }}</p>
                    </div>
                    <div class="col-xs-6"><strong>@lang('app.mobile')</strong> <br>
                        <p class="text-muted">{{ $client->phone or 'NA'}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-xs-6 b-r"><strong>@lang('app.email')</strong> <br>
                        <p class="text-muted">{{ $client->email }}</p>
                    </div>
                    <div class="col-md-3 col-xs-6"><strong>Faculty</strong> <br>
                        <p class="text-muted">{{ $client->faculty->faculty }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-xs-6 b-r"><strong>Staff Number</strong> <br>
                        <p class="text-muted">{{ $client->admission_staff_no }}</p>
                    </div>
                    <div class="col-md-3 col-xs-6"><strong>Gender</strong> <br>
                        <p class="text-muted">
                            @if($client->gender==1)
                                Male
                            @else
                                Female
                            @endif


                        </p>
                    </div>
                </div>


            </div>
        </div>

        <div class="col-md-12">

            <section>
                <div class="sttabs tabs-style-line">
                    <div class="white-box">
                        <nav>
                            <ul>
                                <li class="tab-current"><a href="#"><span>Students</span></a>
                            </ul>
                        </nav>
                    </div>
                    <div class="content-wrap">
                        <section id="section-line-1" class="show">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white-box">
                                        <div class="table-responsive">
                                            <table id="example" class="table" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>ADM</th>
                                                    <th>Course</th>
                                                    <th>Title</th>
                                                    <th>Area</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($students as $key=>$student)
                                                    <tr>
                                                        <td>{{++$key}}</td>
                                                        <td>{{$student->user->name}}</td>
                                                        <td>{{$student->user->admission_staff_no}}</td>
                                                        <td>{{$student->user->course->course}}</td>
                                                        @if($student->proposal==null)
                                                            <td>
                                                                <button class="btn btn-warning btn-xs">Not Proposed
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td>
                                                                {{$student->proposal->title->title}}
                                                            </td>
                                                        @endif
                                                        @if($student->proposal==null)
                                                            <td>
                                                                <button class="btn btn-warning btn-xs">Not Proposed
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td>
                                                                {{$student->proposal->field}}
                                                            </td>
                                                        @endif
                                                        <!--     <td hidden="hidden">{{$student->user->id}}</td> -->
                                                        <td>
                                                            <button type="button"
                                                                    class="btn btn-danger btn-xs btn-circle sa-params "
                                                                    onclick="return deleteUser('{{$student->user->id}}')">
                                                                <span class="fa fa-times"></span>
                                                            </button>
                                                        </td>
                                                        <form action="{{route('admin.removeStudent')}}"
                                                              style="visibility: hidden;" id="{{$student->user->id}}"
                                                              method='POST'>
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="supervisor_id"
                                                                   value="{{$client->id}}">
                                                            <input type="hidden" name="student_id"
                                                                   value="{{$student->id}}">
                                                        </form>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
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
    <script src="{{URL::to('js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable({
                columnDefs: [{
                    targets: [0],
                    orderData: [0, 1]
                }, {
                    targets: [1],
                    orderData: [1, 0]
                }, {
                    targets: [],
                    orderData: [4, 0]
                }]
            });
        });

        function deleteUser(id) {

            // alert(id);
            swal({
                title: "Are you sure?",
                text: "You are about to unassign a Student!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "unassign!",
                closeOnConfirm: false
            }, function (isConfirm) {

                if (isConfirm) {

                    document.getElementById(id).submit();

                }
            });

        }


    </script>
@endpush