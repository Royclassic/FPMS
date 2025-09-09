<style type="text/css">
    .sp-pic > img {
        width: 47px;
        height: 47px;
        border-radius: 50%;
        border: 3px solid rgba(0,0,0,.14);
        box-sizing: content-box;
    }
</style>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <!-- .User Profile -->
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <?php if(is_null($user->image)): ?>
                    <div><img src="<?php echo e(asset('default-profile-2.png')); ?>" alt="user-img" class="img-circle"></div>
                <?php else: ?>
                    <div class="sp-pic"><img src="<?php echo e(asset('profile/'.$user->image)); ?>" alt="user-img" class="img-circle"></div>
                <?php endif; ?>
                <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false"><?php echo e(ucwords($user->name)); ?> <span class="caret"></span></a>
                <ul class="dropdown-menu animated flipInY">
                    <li><a href="<?php echo e(route('supervisor.profile')); ?>"><i
                                    class="ti-user"></i> <?php echo app('translator')->getFromJson("app.menu.profileSettings"); ?></a></li>
                    <li><a href="<?php echo e(route('supervisor.password')); ?>"><i
                                    class="ti-lock"></i> Update Password</a></li>
                    <?php if($user->hasRole('admin')): ?>
                        <li>
                            <a href="<?php echo e(route('admin.dashboard')); ?>">
                                <i class="fa fa-sign-in"></i> <?php echo app('translator')->getFromJson("app.loginAsAdmin"); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                        ><i class="fa fa-power-off"></i> <?php echo app('translator')->getFromJson("app.logout"); ?></a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- .User Profile -->
        <ul class="nav" id="side-menu">
            
            
            
            
            
            
            
            
            
            
            <li><a href="<?php echo e(route('supervisor.dashboard')); ?>" class="waves-effect"><i class="icon-speedometer"></i> <span
                            class="hide-menu"><?php echo app('translator')->getFromJson("app.menu.dashboard"); ?> </span></a></li>

            <!-- <li><a href="<?php echo e(route('supervisor.supervision.area')); ?>" class="waves-effect"><i class="ti-ticket"></i> <span
                            class="hide-menu">Supervision Area </span></a></li> -->
            <li><a href="<?php echo e(route('supervisor.students.view')); ?>" class="waves-effect"><i class="icon-people"></i> <span
                            class="hide-menu">Students</span></a></li>
            <li><a href="<?php echo e(route('supervisor.proposals.titles')); ?>" class="waves-effect"><i class="icon-layers"></i> <span
                            class="hide-menu">Proposals </span> <span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo e(route('supervisor.proposals.titles')); ?>">Titles</a></li>
                    <li><a href="<?php echo e(route('supervisor.proposals.problems')); ?>">Problems</a></li>
                    <li><a href="<?php echo e(route('supervisor.proposals.objectives')); ?>">Objectives</a></li>
                    <li><a href="<?php echo e(route('supervisor.proposals')); ?>">Proposals</a></li>
                    <li><a href="<?php echo e(route('supervisor.proposals.assessment')); ?>">Proposals Assessment</a></li>
                </ul>
            </li>
            <li><a href="<?php echo e(route('supervisor.schedules.view')); ?>" class="waves-effect"><i class="icon-calender"></i> <span
                            class="hide-menu">Schedule</span></a></li>
            <li><a href="<?php echo e(route('supervisor.project.logs')); ?>" class="waves-effect"><i class="icon-clock"></i> <span
                            class="hide-menu">Project Logs</span></a></li>
            <li><a href="<?php echo e(route('supervisor.project.codes')); ?>" class="waves-effect"><i class="icon-docs"></i> <span
                            class="hide-menu"> Project Code </span></a></li>

            <li><a href="<?php echo e(route('supervisor.user-chat.index')); ?>" class="waves-effect"><i class="icon-envelope"></i> <span
                            class="hide-menu"><?php echo app('translator')->getFromJson("app.menu.messages"); ?> <?php if($unreadMessageCount > 0): ?><span
                                class="label label-rouded label-custom pull-right"><?php echo e($unreadMessageCount); ?></span> <?php endif; ?>
                        </span>
                </a>
            </li>
            <li><a href="<?php echo e(route('supervisor.documentation.all')); ?>" class="waves-effect"><i class="icon-docs"></i> <span
                            class="hide-menu"> Documentation </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo e(route('supervisor.documentation.all')); ?>">View</a></li>
                </ul>
            </li>
            <li><a href="<?php echo e(route('supervisor.notices.index')); ?>" class="waves-effect"><i
                            class="ti-layout-media-overlay"></i> <span
                            class="hide-menu"><?php echo app('translator')->getFromJson("app.menu.noticeBoard"); ?> </span></a></li>


        </ul>
    </div>
</div>