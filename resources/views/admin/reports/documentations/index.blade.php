@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> Documentations</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang("app.menu.home")</a></li>
                <li class="active">Project Documentations</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/bower_components/morrisjs/morris.css') }}">
@endpush

@section('content')



    <div class="white-box">
        <div class="row m-b-10">
            <h2>Filter Results</h2>
            <div class="col-md-4">
                {{--<div class="col-md-12">--}}
                   {{--<a href="{{route('admin.reports.students.all')}}" ><button type="button" class="btn btn-success"><i class="fa fa-check"></i> Generate--}}
                       {{--</button></a>--}}
                {{--</div>--}}
                <h5 class="box-title m-t-30">Select Report to generate</h5>
                <form method="POST" action="{{route('admin.reports.documentations.generate')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2 form-control selectpicker" name="report">
                                    <option value="" selected >---------------Select--------------</option>
                                    <option value="completed">Completed Documentation</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-success" ><i class="fa fa-check"></i> Generate
                </button>
            </div>
                </form>


        </div>
    </div>


@endsection

@push('footer-script')


<script src="{{ asset('plugins/bower_components/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/morrisjs/morris.js') }}"></script>

<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<script>

    jQuery('#date-range').datepicker({
        toggleActive: true,
        format: 'yyyy-mm-dd'
    });

</script>
@endpush