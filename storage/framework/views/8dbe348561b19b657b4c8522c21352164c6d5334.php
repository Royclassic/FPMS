
<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> Project Logs</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('student.dashboard.index')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li><a class="active">Project Logs</a></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/html5-editor/bootstrap-wysihtml5.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('css/app_1.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('css/app_3.min.css')); ?>">
    <link href="<?php echo e(URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="<?php echo e(URL::to('summernote/dist/summernote.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .lgi-attrs{
            list-style: none;
            padding: 5px 10px 6px;
            margin: 0;

        }
        .lgi-attrs li{
            border: 1px solid #ccc !important;
            border-color: #4CAF50!important;
            color: #4CAF50;;
        }
        .lgi-attrs li.lgi-approved{
            border-color: #FF9800!important;
            color:#FF9800 !important;
        }
        .lgi-attrs li.lgi-completion{
            border-color: #03A9F4!important;
            color:#03A9F4 !important;
        }
        .lgi-attrs li.lgi-pending{
            border-color: #FF9800!important;
            color:#FF9800 !important;
        }
        .action-header{padding:25px 30px;line-height:100%;position:relative;z-index:1;min-height:65px;background-color:#F7F7F7}
    </style>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12" >
            <div class="white-box">
                <div class="card">
                    <?php if(Session::has('message')): ?>
                        <p class="alert alert-danger"><?php echo e(Session::get('message')); ?></p>
                    <?php endif; ?>
                    <div class="card-header">
                        <h2>Milestone
                            <small>Current Progress logs for the student with the supervisor </small>
                        </h2>
                    </div>

                    <div class="card-body card-padding">
                        <div class="list-group lg-odd-black">
                            <div class="action-header clearfix">
                                <div class="ah-label hidden-xs">Progress Logs for <?php echo e($student->user->name); ?> supervised by <?php echo e($student->supervisor->user->name); ?></div>

                                <div class="ah-search">
                                    <input type="text" placeholder="Start typing..." class="ahs-input">

                                    <i class="ahs-close" data-ma-action="action-header-close">&times;</i>
                                </div>

                                <!-- <ul class="actions">
                                    <li class="dropdown">
                                        <a href="<?php echo e(route('admin.logs.print', $student->id)); ?>" style="color: darkgreen; font-size: 24px">
                                            <i style="color: darkgreen; font-size: 30px" class="zmdi zmdi-local-printshop"></i>
                                        </a>

                                    </li>
                                </ul> -->
                            </div>
                            <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="list-group-item media">
                                    <div class="checkbox pull-left">
                                        <label>
                                            <input type="checkbox" value="">
                                            <i class="input-helper"></i>
                                        </label>
                                    </div>
                                    <div class="media-body">
                                        <div class="lgi-heading" style="overflow: auto;"><?php echo e($log->milestone); ?></div>
                                        <small class="lgi-text"><b>Supervisor additional :</b> <?php echo e($log->additional_tasks); ?></small>
                                        <?php if($log->comments!==null): ?>
                                            <div class="list-group-item media" style="background-color: inherit!important;">
                                                <div style="padding-left: 15px;">
                                                </div>
                                                <div class="pull-left">
                                                    <?php if($student->supervisor->user->image==!null): ?>
                                                        <img class="lgi-img" src="<?php echo e(url('profile/'.$student->supervisor->user->image)); ?>" alt="">
                                                    <?php else: ?>
                                                        <img class="lgi-img" src="<?php echo e(URL::to('default-profile.jpg')); ?>" alt="">
                                                    <?php endif; ?>
                                                </div>

                                                <div class="media-body">
                                                    <div class="lgi-heading"><?php echo e($student->supervisor->user->name); ?></div>
                                                    <small class="lg-hide-items"><?php echo e($log->comments); ?></small>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <ul class="lgi-attrs">
                                            <li class="f-500">Date Created: <?php echo e($log->created_at->toDayDateTimeString()); ?></li>
                                            <?php if($log->approved==1): ?>
                                                <li class="f-500">Approved: Yes</li>
                                            <?php elseif($log->approved==0): ?>
                                                <li class="f-500">Approved: Pending</li>
                                            <?php endif; ?>
                                            <li class="f-500">Assessed on : <?php echo e($log->updated_at->toDayDateTimeString()); ?> </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                        <?php if(!empty($warning)): ?>
                            <p class="alert alert-danger"><?php echo e($warning); ?></p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/bootstrap-wysihtml5.js')); ?>"></script>
    <script src="<?php echo e(URL::to('summernote/dist/summernote.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>