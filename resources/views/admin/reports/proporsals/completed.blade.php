<!DOCTYPE html>
<html>
<head>
    <title>Students Proposals</title>

    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    {{--<link rel="stylesheet" href="{{asset('dataTables.bootstrap.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('public/plugins/dataTables/responsive.bootstrap.min.css')}}">

</head>
<style type="text/css">
    hr.style2 {
        border-top: 3px double #8c8b8b !important;
        height: 1px;
    }
</style>
<body>

<div style="text-align: center"><img style="text-align: center" width="125" height="125" src="{{URL::to('logo.png')}}" class="img-thumbnail"></div>
<figcaption><h3 style="text-align: center">WorkMate</h3></figcaption>
<hr class="style2" style="font-size: larger;">
<h2 >Completed Proposals</h2>
<p style="text-align: right">
    <?php
    date_default_timezone_set('Africa/Nairobi');
    echo " <b style='text-align:right!important;'> Printed On</b> : " . date("Y/m/d") . "<b> At</b> " . date("h:i:sa");
    ?>
</p>
<table class="table table-bordered table-hover toggle-circle default footable-loaded footable">
    <thead>
    <tr>
        <th>#</th>
        <th>Student</th>
        <th>Admission</th>
        <th>Faculty</th>
        <th>Course</th>
        <th>Field</th>
        <th>Title</th>
        <th>Supervisor</th>
        <th width="80">Created on</th>

    </tr>
    </thead>
    <tbody>
    @foreach($proposals as $key=>$proposal)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$proposal->student->user->name}}</td>
            <td>{{$proposal->student->user->admission_staff_no}}</td>
            <td>{{$proposal->student->user->faculty->faculty}}</td>
            <td>{{$proposal->student->user->course->course}}</td>
            <td>{!! $proposal->field !!}</td>
            <td>{{$proposal->title->title}}</td>
            <td>{{$proposal->student->supervisor->user->name}}</td>
            <td>{{Carbon\Carbon::parse($proposal->created_at)->format('d-m-Y')}}</td>
        </tr>
    @endforeach
    </tbody>


</table>
<!-- jQuery -->
<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>

</body>
</html>