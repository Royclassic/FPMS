<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <link href="{{URL::to('bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <title>Student Panel | Change-Password-To-Continue</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel='stylesheet prefetch'
          href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css'>
    <link rel='stylesheet prefetch'
          href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css'>

    <!-- This is Sidebar menu CSS -->
    <link href="{{ asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">

    <link href="{{ asset('plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <!-- This is a Animation CSS -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

</head>
<body>
<div class="col-md-8 col-md-offset-3 col-lg-12  col-sm-12 col-sm-offset-3"  >
    <div class="white-box">
        <div class="row in">
            <div class="col-lg-6 col-sm-6 row-in-br">
                <form class="form-horizontal" role="form" action="{{route('student.firstLogin')}}" method="POST">
                    {{csrf_field()}}
                    @if(Session::has('message'))
                        <p class="alert alert-danger">{{ Session::get('message') }}</p>
                    @endif
                    <div class="card-header warning">
                        <h2 style="color: #FFC107;">You Must Change Password to Proceed</h2>
                    </div>
                    <div class="card-body card-padding">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">New Password</label>
                            <div class="col-sm-10">

                                <div class="fg-line{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input type="password" class="form-control input-sm" id="password"
                                           name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
				                                        <strong>{{ $errors->first('password') }}</strong>
				                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Confirm</label>
                            <div class="col-sm-10">

                                <div class="fg-line{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <input type="password" class="form-control input-sm" id="password_confirmation"
                                           name="password_confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
					                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
					                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary btn-sm" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

</section>

@yield('scripts')
<!-- Javascript Libraries -->

<script src="{{URL::to('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<script src="{{URL::to('vendors/bower_components/flot/jquery.flot.js')}}"></script>
<script src="{{URL::to('vendors/bower_components/flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::to('vendors/bower_components/flot.curvedlines/curvedLines.js')}}"></script>
<script src="{{URL::to('vendors/sparklines/jquery.sparkline.min.js')}}"></script>
<script src="{{URL::to('vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>

<script src="{{URL::to('vendors/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{URL::to('vendors/bower_components/fullcalendar/dist/fullcalendar.min.js')}} "></script>
<script src="{{URL::to('vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js')}}"></script>
<script src="{{URL::to('vendors/bower_components/Waves/dist/waves.min.js')}}"></script>
<script src="{{URL::to('vendors/bootstrap-growl/bootstrap-growl.min.js')}}"></script>
<script src="{{URL::to('vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>
<script src="{{URL::to('vendors/input-mask/input-mask.min.js')}}"></script>
<script src="{{URL::to('vendors/bower_components/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{URL::to('vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{URL::to('vendors/bootgrid/jquery.bootgrid.updated.min.js')}}"></script>



<!--  -->
</body>

</html>
