<ul class="nav tabs-vertical">
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.settings.index') active @endif">
        <a href="{{ route('admin.settings.index') }}">@lang('app.menu.accountSettings')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.profile-settings.index') active @endif">
        <a href="{{ route('admin.profile-settings.index') }}">@lang('app.menu.profileSettings')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.email-settings.index') active @endif">
        <a href="{{ route('admin.email-settings.index') }}">@lang('app.menu.emailSettings')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.module-settings.index') active @endif">
        <a href="{{ route('admin.module-settings.index') }}">@lang('app.menu.moduleSettings')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.currency.index') active @endif">
        <a href="{{ route('admin.currency.index') }}">@lang('app.menu.currencySettings')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.theme-settings.index') active @endif">
        <a href="{{ route('admin.theme-settings.index') }}">@lang('app.menu.themeSettings')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.payment-gateway-credential.index') active @endif">
        <a href="{{ route('admin.payment-gateway-credential.index') }}">@lang('app.menu.paymentGatewayCredential')</a>
    </li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.invoice-settings.index') active @endif">
        <a href="{{ route('admin.invoice-settings.index') }}">@lang('app.menu.invoiceSettings')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.slack-settings.index') active @endif">
        <a href="{{ route('admin.slack-settings.index') }}">@lang('app.menu.slackSettings')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.ticket-agents.index') active @endif">
        <a href="{{ route('admin.ticket-agents.index') }}">@lang('app.menu.ticketSettings')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.attendance-settings.index') active @endif">
        <a href="{{ route('admin.attendance-settings.index') }}">@lang('app.menu.attendanceSettings')</a></li>
    <li class="tab @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.update-settings.index') active @endif">
        <a href="{{ route('admin.update-settings.index') }}">@lang('app.menu.updates')</a></li>
</ul>