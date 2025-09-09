<ul class="nav tabs-vertical">
    <li class="tab">
        <a href="{{ route('admin.settings.index') }}" class="text-danger"><i class="ti-arrow-left"></i> @lang('app.menu.settings')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.ticket-agents.index') active @endif">
        <a href="{{ route('admin.ticket-agents.index') }}">@lang('app.menu.ticketAgents')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.ticketTypes.index') active @endif">
        <a href="{{ route('admin.ticketTypes.index') }}">@lang('app.menu.ticketTypes')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.ticketChannels.index') active @endif">
        <a href="{{ route('admin.ticketChannels.index') }}">@lang('app.menu.ticketChannel')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.replyTemplates.index') active @endif">
        <a href="{{ route('admin.replyTemplates.index') }}">@lang('app.menu.replyTemplates')</a></li>
</ul>