<style type="text/css">
    .sp-pic > img {
        width: 47px;
        height: 47px;
        border-radius: 50%;
        border: 3px solid rgba(0, 0, 0, .14);
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
                    <div class="sp-pic"><img src="<?php echo e(asset('profile/'.$user->image)); ?>" alt="user-img"
                                             class="img-circle"></div>
                <?php endif; ?>
                <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false"><?php echo e(ucwords($user->name)); ?> <span class="caret"></span></a>
                <ul class="dropdown-menu animated flipInY">
                    <li><a href="<?php echo e(route('student.profile')); ?>"><i
                                    class="ti-user"></i> <?php echo app('translator')->getFromJson("app.menu.profileSettings"); ?></a></li>
                    <li><a href="<?php echo e(route('student.password')); ?>"><i
                                    class="ti-lock"></i> Update Password</a></li>
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
            
            
            
            
            
            
            
            
            
            
            <li><a href="<?php echo e(route('student.dashboard.index')); ?>" class="waves-effect"><i
                            class="icon-speedometer"></i> <span
                            class="hide-menu"><?php echo app('translator')->getFromJson('app.menu.dashboard'); ?> </span></a></li>
            <li><a href="<?php echo e(route('student.proposal.title')); ?>" class="waves-effect"><i class="icon-layers"></i>
                    <span class="hide-menu">Proposal</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo e(route('student.proposal.title')); ?>">Title</a></li>
                    <li><a href="<?php echo e(route('student.proposal.problem')); ?>">Problem Statement</a></li>
                    <li><a href="<?php echo e(route('student.proposal.objectives')); ?>">Objectives</a></li>
                    <li><a href="<?php echo e(route('student.proposal.upload')); ?>">Proposals</a></li>
                </ul>

            </li>
            <li><a href="<?php echo e(route('student.schedule')); ?>" class="waves-effect"><i class="icon-calender"></i> <span
                            class="hide-menu">Schedule </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo e(route('student.schedule')); ?>">Project Schedule</a></li>
                    <li><a href="<?php echo e(route('student.gantt')); ?>">Gantt Chart</a></li>
                </ul>
            </li>
            <li><a href="<?php echo e(route('student.logs.index')); ?>" class="waves-effect"><i class="icon-clock"></i> <span
                            class="hide-menu"> Project Logs </span></a></li>
            <li><a href="<?php echo e(route('student.files.overview')); ?>" class="waves-effect"><i class="icon-docs"></i> <span
                            class="hide-menu"> Project Code </span></a></li>
            <li><a href="<?php echo e(route('student.user-chat.index')); ?>" class="waves-effect"><i class="icon-envelope"></i>
                    <span
                            class="hide-menu">Messages <?php if($unreadMessageCount > 0): ?><span
                                class="label label-rouded label-custom pull-right"><?php echo e($unreadMessageCount); ?></span> <?php endif; ?>
                        </span>
                </a>
            </li>
            <li><a href="<?php echo e(route('student.documentation.chapterone')); ?>" class="waves-effect"><i class="icon-docs"></i>
                    <span
                            class="hide-menu"> Documentation </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo e(route('student.documentation.chapterone')); ?>">Chapter One</a></li>
                    <li><a href="<?php echo e(route('student.documentation.chaptertwo')); ?>">Chapter Two</a></li>
                    <li><a href="<?php echo e(route('student.documentation.chapterthree')); ?>">Chapter Three</a></li>
                    <li><a href="<?php echo e(route('student.documentation.final')); ?>">Final Document</a></li>
                </ul>
            </li>
            <li><a href="<?php echo e(route('student.notices.index')); ?>" class="waves-effect"><i
                            class="ti-layout-media-overlay"></i> <span
                            class="hide-menu"><?php echo app('translator')->getFromJson("app.menu.noticeBoard"); ?> </span></a></li>
        </ul>
    </div>
</div>