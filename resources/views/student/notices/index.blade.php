@extends('layouts.client-app')

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
                <li><a href="{{ route('student.dashboard.index') }}">@lang('app.menu.home')</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="white-box">
                <h2>@lang('app.menu.noticeBoard')</h2>

                <ul class="list-group" id="issues-list">

                    @forelse($notices as $notice)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <h4>{{ ucfirst($notice->heading) }}</h4>
                                </div>
                                <div class="col-md-5 text-right">
                                    <span class="text-info">{{ $notice->created_at->format('d M, y') }}</span>
                                </div>
                            </div>

                            <div class="row m-t-20">
                                <div class="col-md-12">
                                    {!!nl2br($notice->description)  !!}
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12">
                                    @lang('messages.noNotice')
                                </div>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
    <!-- .row -->

@endsection