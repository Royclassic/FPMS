<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <!-- .User Profile -->
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                @if(is_null($user->image))
                    <div><img src="{{ asset('default-profile.jpg') }}" alt="user-img" class="img-circle"></div>
                @else
                    <div><img src="{{ asset('storage/avatar/'.$user->image) }}" alt="user-img" class="img-circle"></div>
                @endif
                <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">{{ ucwords($user->name) }} <span class="caret"></span></a>
                <ul class="dropdown-menu animated flipInY">
                    <li><a href="{{route('admin.password.change')}}"><i
                                    class="ti-lock"></i> Change password</a></li>

                    <li role="separator" class="divider"></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                        ><i class="fa fa-power-off"></i> @lang('app.logout')</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- .User Profile -->
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- / Search input-group this is only view in mobile-->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                        </span>
                </div>
                <!-- /input-group -->
            </li>
            <li><a href="{{ route('admin.dashboard') }}" class="waves-effect"><i class="icon-speedometer"></i> <span
                            class="hide-menu">@lang('app.menu.dashboard') </span></a></li>
            <li><a href="{{ route('admin.students.index') }}" class="waves-effect"><i class="icon-people"></i> <span
                            class="hide-menu">@lang('app.menu.clients') </span>   </a>

            </li>
            <li><a href="{{ route('admin.supervisors.index') }}" class="waves-effect"><i class="icon-user"></i> <span
                            class="hide-menu">Supervisors </span> <span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ route('admin.supervisors.index') }}">View</a></li>
                                <li><a href="{{ route('admin.students.assign') }}">Assign Students</a></li>
                            </ul>
            </li>
            <li><a href="{{ route('admin.students.proposals') }}" class="waves-effect"><i class="icon-layers"></i> <span
                            class="hide-menu">Proposals </span></a></li>
            <li><a href="{{ route('admin.project.logs') }}" class="waves-effect"><i class="icon-clock"></i> <span
                            class="hide-menu">Project Logs </span></a></li>
            <li><a href="{{ route('admin.documentation.all') }}" class="waves-effect"><i class="ti-receipt"></i> <span
                            class="hide-menu">Documentations</span></a></li>
            <li><a href="{{ route('admin.project.codes') }}" class="waves-effect"><i class="icon-docs"></i> <span
                            class="hide-menu"> Project Code </span></a></li>

            <li><a href="{{ route('admin.user-chat.index') }}" class="waves-effect"><i class="icon-envelope"></i> <span
                            class="hide-menu">@lang('app.menu.messages') @if($unreadMessageCount > 0)<span
                                class="label label-rouded label-custom pull-right">{{ $unreadMessageCount }}</span> @endif</span></a>
            </li>
            <li><a href="{{ route('admin.notices.index') }}" class="waves-effect"><i
                            class="ti-layout-media-overlay"></i> <span
                            class="hide-menu">@lang('app.menu.noticeBoard') </span></a></li>
            <!-- <li><a href="{{ route('admin.reports.students') }}" class="waves-effect"><i class="ti-pie-chart"></i> <span
                            class="hide-menu">Reports <span class="fa arrow"></span> </span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('admin.reports.students') }}">Students</a></li>
                    <li><a href="{{ route('admin.reports.supervisors') }}">Supervisors</a></li>
                    <li><a href="{{ route('admin.reports.proposals') }}">Proposals</a></li>
                    <li><a href="{{ route('admin.reports.documentations') }}">Documentations</a></li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>