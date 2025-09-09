<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <!-- .User Profile -->
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <?php if(is_null($user->image)): ?>
                    <div><img src="<?php echo e(asset('default-profile.jpg')); ?>" alt="user-img" class="img-circle"></div>
                <?php else: ?>
                    <div><img src="<?php echo e(asset('storage/avatar/'.$user->image)); ?>" alt="user-img" class="img-circle"></div>
                <?php endif; ?>
                <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false"><?php echo e(ucwords($user->name)); ?> <span class="caret"></span></a>
                <ul class="dropdown-menu animated flipInY">
                    <li><a href="<?php echo e(route('admin.password.change')); ?>"><i
                                    class="ti-lock"></i> Change password</a></li>

                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                        ><i class="fa fa-power-off"></i> <?php echo app('translator')->getFromJson('app.logout'); ?></a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

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
            <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="waves-effect"><i class="icon-speedometer"></i> <span
                            class="hide-menu"><?php echo app('translator')->getFromJson('app.menu.dashboard'); ?> </span></a></li>
            <li><a href="<?php echo e(route('admin.students.index')); ?>" class="waves-effect"><i class="icon-people"></i> <span
                            class="hide-menu"><?php echo app('translator')->getFromJson('app.menu.clients'); ?> </span>   </a>

            </li>
            <li><a href="<?php echo e(route('admin.supervisors.index')); ?>" class="waves-effect"><i class="icon-user"></i> <span
                            class="hide-menu">Supervisors </span> <span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo e(route('admin.supervisors.index')); ?>">View</a></li>
                                <li><a href="<?php echo e(route('admin.students.assign')); ?>">Assign Students</a></li>
                            </ul>
            </li>
            <li><a href="<?php echo e(route('admin.students.proposals')); ?>" class="waves-effect"><i class="icon-layers"></i> <span
                            class="hide-menu">Proposals </span></a></li>
            <li><a href="<?php echo e(route('admin.project.logs')); ?>" class="waves-effect"><i class="icon-clock"></i> <span
                            class="hide-menu">Project Logs </span></a></li>
            <li><a href="<?php echo e(route('admin.documentation.all')); ?>" class="waves-effect"><i class="ti-receipt"></i> <span
                            class="hide-menu">Documentations</span></a></li>
            <li><a href="<?php echo e(route('admin.project.codes')); ?>" class="waves-effect"><i class="icon-docs"></i> <span
                            class="hide-menu"> Project Code </span></a></li>

            <li><a href="<?php echo e(route('admin.user-chat.index')); ?>" class="waves-effect"><i class="icon-envelope"></i> <span
                            class="hide-menu"><?php echo app('translator')->getFromJson('app.menu.messages'); ?> <?php if($unreadMessageCount > 0): ?><span
                                class="label label-rouded label-custom pull-right"><?php echo e($unreadMessageCount); ?></span> <?php endif; ?></span></a>
            </li>
            <li><a href="<?php echo e(route('admin.notices.index')); ?>" class="waves-effect"><i
                            class="ti-layout-media-overlay"></i> <span
                            class="hide-menu"><?php echo app('translator')->getFromJson('app.menu.noticeBoard'); ?> </span></a></li>
            <!-- <li><a href="<?php echo e(route('admin.reports.students')); ?>" class="waves-effect"><i class="ti-pie-chart"></i> <span
                            class="hide-menu">Reports <span class="fa arrow"></span> </span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo e(route('admin.reports.students')); ?>">Students</a></li>
                    <li><a href="<?php echo e(route('admin.reports.supervisors')); ?>">Supervisors</a></li>
                    <li><a href="<?php echo e(route('admin.reports.proposals')); ?>">Proposals</a></li>
                    <li><a href="<?php echo e(route('admin.reports.documentations')); ?>">Documentations</a></li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>