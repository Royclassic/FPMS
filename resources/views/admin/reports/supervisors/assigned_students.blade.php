<!DOCTYPE html>
<html>
<head>
    <title>Supervisors Reports</title>

    {{--<link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">--}}
    {{--<link rel="stylesheet" href="{{asset('dataTables.bootstrap.min.css')}}">--}}

</head>
<body>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

</style>
<style type="text/css">
    hr.style2 {
        border-top: 3px double #8c8b8b !important;
        height: 1px;
    }
</style>
<div style="text-align: center"><img style="text-align: center" width="125" height="125" src="{{URL::to('logo.png')}}"
                                     class="img-thumbnail"></div>
<figcaption><h3 style="text-align: center">WorkMate</h3></figcaption>
<hr class="style2" style="font-size: larger;">
<h2 style="text-align: center">Assigned Students to Supervisors</h2>
<p style="text-align: right">
    <?php
    date_default_timezone_set('Africa/Nairobi');
    echo " <b style='text-align:right!important;'> Printed On</b> : " . date("Y/m/d") . "<b> At</b> " . date("h:i:sa");
    ?>
</p>
@foreach($supervisors as $key=>$supervisor)
  @if($supervisor->id!==1)
 <div>
     <p><b>Supervisor:</b> <span>{{$supervisor->name}}</span></p>
     <p><b>Staff Number:</b> <span>{{$supervisor->admission_staff_no}}</span></p>
     <p><b>Email:</b> <span>{{$supervisor->email}} </span></p>
     <p><b>Faculty:</b> <span>{{$supervisor->faculty}}</span></p>

 </div>
<table class="table table-bordered table-hover toggle-circle default footable-loaded footable">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Admission</th>
        <th>Faculty</th>
        <th>Email</th>
        <th width="80">Created on</th>

    </tr>
    </thead>
    <tbody>
    @if(\App\Student::where('supervisor_id', '<>', null))
        @if($supervisor->id!==1)
        @foreach(\App\Student::where('supervisor_id', '=',$supervisor->supervisor_id)->get() as $student)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$student->user->name}}</td>
                        <td>{{$student->user->admission_staff_no}}</td>
                        <td>{{$student->user->faculty->faculty}}</td>
                        <td>{{$student->user->email}}</td>
                        <td>{{Carbon\Carbon::parse($student->created_at)->format('d-m-Y')}}</td>

                    </tr>
        @endforeach
        @endif
    @endif

    </tbody>


</table>
<hr style="font-size: larger;">
 @endif
@endforeach
<!-- jQuery -->
{{--<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>--}}
<!-- Bootstrap Core JavaScript -->
{{--<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>--}}

</body>
</html>