@extends('layouts.client-app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> Gantt Chart</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('student.dashboard.index') }}">@lang('app.menu.home')</a></li>
                <li><a class="active">Gantt Chart/a></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/html5-editor/bootstrap-wysihtml5.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/app_1.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/app_2.min.css') }}">
    <link href="{{URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="{{URL::to('summernote/dist/summernote.css')}}" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="card">
                    <div class="card-header">
                        <h2>Project Gantt Chart
                            <small>Your project schedule on a gantt chart</small>
                        </h2>
                    </div>
                    <div class="body card-padding">
                        <div id="chat_render" ></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['gantt']});
        google.charts.setOnLoadCallback(drawChart);

        function daysToMilliseconds(days) {
            return days * 24 * 60 * 60 * 1000;
        }

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Task ID');
            data.addColumn('string', 'Task Name');
            data.addColumn('date', 'Start Date');
            data.addColumn('date', 'End Date');
            data.addColumn('number', 'Duration');
            data.addColumn('number', 'Percent Complete');
            data.addColumn('string', 'Dependencies');
            @foreach($schedules as $schedule)
            data.addRows([
                ['{{$schedule->id}}', '{{$schedule->task_name}}',
                    new Date('{{\Carbon\Carbon::parse($schedule->start)->format('Y')}}',
                        '{{\Carbon\Carbon::parse($schedule->start)->format('m')-1}}', '{{\Carbon\Carbon::parse($schedule->start)->format('d')}}'),null,
                    daysToMilliseconds({{$schedule->duration}}), 0,  '{{$schedule->dependency}}']]);
                    @endforeach

            var options = {
                    height: 500
                };

            var chart = new google.visualization.Gantt(document.getElementById('chat_render'));

            chart.draw(data, options);
        }
    </script>
@endsection

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/html5-editor/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{URL::to('summernote/dist/summernote.js')}}"></script>
    <script>
        $('.textarea_editor').wysihtml5();

    </script>

@endpush