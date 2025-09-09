<!DOCTYPE html>
<html>
<head>
    <title>Students Reports</title>

    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    {{--<link rel="stylesheet" href="{{asset('dataTables.bootstrap.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('public/plugins/dataTables/responsive.bootstrap.min.css')}}">
    <style type="text/css">
        hr.style2 {
            border-top: 3px double #8c8b8b !important;
            height: 1px;
        }
    </style>
</head>
<body>

<div style="text-align: center"><img style="text-align: center" width="125" height="125" src="{{URL::to('logo.png')}}" class="img-thumbnail"></div>
<figcaption><h3 style="text-align: center">WorkMate</h3></figcaption>
<hr style="font-size: larger;">
<hr class="style2" style="font-size: larger;">
<h2 style="text-align: center">Dormant Students Accounts</h2>
<p style="text-align: right">
    <?php
    date_default_timezone_set('Africa/Nairobi');
    echo " <b style='text-align:right!important;'> Printed On</b> : " . date("Y/m/d") . "<b> At</b> " . date("h:i:sa");
    ?>
</p>
<table class="table table-bordered table-hover toggle-circle default footable-loaded footable">
    <thead>
    <tr>
        <th># </th>
        <th>Name</th>
        <th>Staff Number</th>
        <th>Faculty</th>
        <th>Course</th>
        <th>Email</th>
        <th width="80">Created on</th>

    </tr>
    </thead>
    <tbody>
    @foreach($students as $key=>$student)
        @if($student->passrec==0)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$student->name}}</td>
                <td>{{$student->admission_staff_no}}</td>
                <td>{{$student->faculty}}
                <td>{{$student->course}}</td>
                <td>{{$student->email}}</td>
                <td>{{Carbon\Carbon::parse($student->created_at)->format('d-m-Y')}}</td>

            </tr>
        @endif
    @endforeach
    </tbody>


</table>
<!-- jQuery -->
<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>

</body>
</html>