
<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="ui-icon-person"></i> Student Profile</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('student.dashboard.index')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('student.proposal.title')); ?>">Student Profile</a></li>
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
    <link rel="stylesheet" href="<?php echo e(URL::to('css/app_2.min.css')); ?>">
    <link href="<?php echo e(URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="<?php echo e(URL::to('summernote/dist/summernote.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <style type="text/css">
        #profile-main{
            min-height: 470px;
            max-height: inherit;
        }
        #clearfix{
            min-width: 470px;
        }

        #center{
            min-height: 400px;
            max-height: 400px;
            max-width: 400px;
            min-width: 400px;
        }
        #pic{
            min-height: 300px;
            max-height: 300px;
        }
        #f-menu{
            display: inline-block;

            padding-left: 0;
            margin-left: -5px;
            margin-top: 5px;
            list-style: none;
        }
        #f-menu li{
            display: inline-block;
            padding-left: 5px;
            padding-right: 5px;

        }

    </style>
    <div class="container container-alt ">

        <div class="block-header">
            <h2><?php echo e($student->name); ?>

                <small> <?php echo e($student->admission_staff_no); ?> </small>
            </h2>
        </div>

        <div class="card col-md-3 profile" id="profile-main" >
            <div class="pm-overview c-overflow">
                <div class="pmo-pic" >
                    <div class="p-relative"  >
                        <a href="#">
                            <?php if($student->image===null): ?>
                                    <img src="<?php echo e(url('default-profile.jpg')); ?>" alt="">
                            <?php else: ?>
                                <img id="pic" class="img-responsive" src="<?php echo e(URL::to('/profile/'. $student->image)); ?>" alt="">
                            <?php endif; ?>
                        </a>

                    </div>

                </div>
            </div>

        </div>
        <div class="pm-body clearfix col-md-9" id="clearfix">
            <div class="container container-alt">
                <div class="card" id="profile-main" >

                    <div class="pm-body clearfix">
                        <div class="pmb-block ">
                            <div class="pmbb-header">
                                <h2><i class="zmdi zmdi-account m-r-10"></i> Basic Information</h2>

                            </div>
                            <div class="pmbb-body p-l-30">

                                <div class="pmbb-view">
                                    <dl class="dl-horizontal">
                                        <dt>Full Names</dt>
                                        <dd><?php echo e($student->name); ?></dd>
                                    </dl>

                                    <dl class="dl-horizontal">
                                        <dt>Gender</dt>
                                        <dd><?php echo e($student->gender); ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="pmb-block">
                            <div class="pmbb-header">
                                <h2><i class="zmdi zmdi-phone m-r-10"></i> Contact Information</h2>

                            </div>
                            <div class="pmbb-body p-l-30">
                                <div class="pmbb-view">
                                    <dl class="dl-horizontal">
                                        <dt>Mobile Phone</dt>
                                        <dd><?php echo e($student->phone); ?></dd>
                                    </dl>
                                    <dl class="dl-horizontal">
                                        <dt>Email Address</dt>
                                        <dd><?php echo e($student->email); ?></dd>
                                    </dl>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.member-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>