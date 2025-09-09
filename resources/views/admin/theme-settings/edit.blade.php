@extends('layouts.app')

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
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
<link rel="stylesheet" href="{{ asset('plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css') }}">
@endpush

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">{{ $pageTitle }}</div>

                <div class="vtabs customvtab m-t-10">
                    @include('sections.admin_setting_menu')

                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="white-box">
                                        {!! Form::open(['id'=>'editSettings','class'=>'ajax-form','method'=>'POST']) !!}
                                        <h3 class="box-title m-b-0"><b>@lang('modules.themeSettings.adminPanelTheme')</b></h3>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.headerColor')</p>
                                                    <input type="text" class="colorpicker form-control" required name="theme_settings[1][header_color]" value="{{ $adminTheme->header_color }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.sidebarColor')</p>
                                                    <input type="text" class="complex-colorpicker form-control" required name="theme_settings[1][sidebar_color]" value="{{ $adminTheme->sidebar_color }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.sidebarTextColor')</p>
                                                    <input type="text" class="complex-colorpicker form-control" required name="theme_settings[1][sidebar_text_color]" value="{{ $adminTheme->sidebar_text_color }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.linkColor')</p>
                                                    <input type="text" class="complex-colorpicker form-control" required name="theme_settings[1][link_color]" value="{{ $adminTheme->link_color }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <h3 class="box-title m-b-0"><b>@lang('modules.themeSettings.projectAdminPanelTheme')</b></h3>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.headerColor')</p>
                                                    <input type="text" class="colorpicker form-control" required name="theme_settings[2][header_color]" value="{{ $projectAdminTheme->header_color }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.sidebarColor')</p>
                                                    <input type="text" class="complex-colorpicker form-control" required name="theme_settings[2][sidebar_color]" value="{{ $projectAdminTheme->sidebar_color }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.sidebarTextColor')</p>
                                                    <input type="text" class="complex-colorpicker form-control" required name="theme_settings[2][sidebar_text_color]" value="{{ $projectAdminTheme->sidebar_text_color }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.linkColor')</p>
                                                    <input type="text" class="complex-colorpicker form-control" required name="theme_settings[2][link_color]" value="{{ $projectAdminTheme->link_color }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 class="box-title m-b-0"><b>@lang('modules.themeSettings.employeePanelTheme')</b></h3>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.headerColor')</p>
                                                    <input type="text" class="colorpicker form-control" required name="theme_settings[3][header_color]" value="{{ $employeeTheme->header_color }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.sidebarColor')</p>
                                                    <input type="text" class="complex-colorpicker form-control" required name="theme_settings[3][sidebar_color]" value="{{ $employeeTheme->sidebar_color }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.sidebarTextColor')</p>
                                                    <input type="text" class="complex-colorpicker form-control" required name="theme_settings[3][sidebar_text_color]" value="{{ $employeeTheme->sidebar_text_color }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.linkColor')</p>
                                                    <input type="text" class="complex-colorpicker form-control" required name="theme_settings[3][link_color]" value="{{ $employeeTheme->link_color }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 class="box-title m-b-0"><b>@lang('modules.themeSettings.clientPanelTheme')</b></h3>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.headerColor')</p>
                                                    <input type="text" class="colorpicker form-control" required name="theme_settings[4][header_color]" value="{{ $clientTheme->header_color }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.sidebarColor')</p>
                                                    <input type="text" class="complex-colorpicker form-control" required name="theme_settings[4][sidebar_color]" value="{{ $clientTheme->sidebar_color }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.sidebarTextColor')</p>
                                                    <input type="text" class="complex-colorpicker form-control" required name="theme_settings[4][sidebar_text_color]" value="{{ $clientTheme->sidebar_text_color }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="example">
                                                    <p class="box-title m-t-30">@lang('modules.themeSettings.linkColor')</p>
                                                    <input type="text" class="complex-colorpicker form-control" required name="theme_settings[4][link_color]" value="{{ $clientTheme->link_color }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <h3 class="box-title m-b-0"><b>@lang('modules.themeSettings.loginScreenBackground')</b></h3>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            @if(is_null($global->login_background))
                                                                <img src="https://placeholdit.imgix.net/~text?txtsize=25&txt=@lang('modules.themeSettings.uploadImage')&w=200&h=150" alt=""/>
                                                            @else
                                                                <img src="{{asset('storage/login-background.jpg') }}" alt="" />
                                                            @endif
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                                             style="max-width: 200px; max-height: 150px;"></div>
                                                        <div>
                                <span class="btn btn-info btn-file">
                                    <span class="fileinput-new"> @lang('app.selectImage') </span>
                                    <span class="fileinput-exists"> @lang('app.change') </span>
                                    <input type="file" name="login_background"> </span>
                                                            <a href="javascript:;" class="btn btn-danger fileinput-exists"
                                                               data-dismiss="fileinput"> @lang('app.remove') </a>
                                                        </div>
                                                    </div>
                                                    <div class="note">Recommended size: 1500 X 1056 (Pixels)</div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 m-t-30">
                                                <button class="btn btn-success" id="save-form" type="submit"><i class="fa fa-check"></i> @lang('app.save')</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <!-- .row -->



@endsection

@push('footer-script')
<script src="{{ asset('plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js') }}"></script>
<script src="{{ asset('plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js') }}"></script>
<script src="{{ asset('plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js') }}"></script>

<script>
    // Colorpicker

    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });

    $('#save-form').click(function () {
        $.easyAjax({
            url: '{{route('admin.theme-settings.store')}}',
            container: '#editSettings',
            data: $('#editSettings').serialize(),
            type: "POST",
            redirect: true,
            file: true
        })
    });
</script>
@endpush

