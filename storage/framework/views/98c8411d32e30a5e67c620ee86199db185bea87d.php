

<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e($pageTitle); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e($pageTitle); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/morrisjs/morris.css')); ?>"><!--Owl carousel CSS -->
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/owl.carousel/owl.carousel.min.css')); ?>"><!--Owl carousel CSS -->
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/owl.carousel/owl.theme.default.css')); ?>"><!--Owl carousel CSS -->

<style>
    .col-in{
        padding: 0 20px !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="row row-in">
                    <div class="col-lg-3 col-sm-6 row-in-br">
                        <div class="col-in row">
                            <h3 class="box-title">Total Students</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-user text-success"></i></li>
                                <li class="text-right"><span class="counter"><?php echo e($counts->totalStudents); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                        <div class="col-in row">
                            <h3 class="box-title">Total Supervisors</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-people text-warning"></i></li>
                                <li class="text-right"><span class="counter"><?php echo e($counts->totalLecturers); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6  row-in-br">
                        <div class="col-in row">
                            <h3 class="box-title">Total Projects</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-layers text-danger"></i></li>
                                <li class="text-right"><span class="counter"><?php echo e($counts->totalProjects); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 row-in-br">
                        <div class="col-in row">
                            <h3 class="box-title">Total Project logs</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-clock text-info"></i></li>
                                <li class="text-right"><span class="counter"><?php echo e($counts->totalLogs); ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="row row-in">

                    <div class="col-md-4 col-sm-12  row-in-br  b-r-none">
                        <div class="col-in row">
                            <h3 class="box-title">Total  Documentations</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-docs text-info"></i></li>
                                <li class="text-right"><span class="counter"><?php echo e($counts->totalDocumentations); ?></span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12 row-in-br ">
                        <div class="col-in row">
                            <h3 class="box-title">System Notices</h3>
                            <ul class="list-inline two-part">
                                <li><i class="ui-icon-notice text-success"></i></li>
                                <li class="text-right"><span class="counter"><?php echo e($counts->totalNotices); ?></span></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- .row -->


<?php $__env->stopSection(); ?>


<?php $__env->startPush('footer-script'); ?>


<script src="<?php echo e(asset('plugins/bower_components/raphael/raphael-min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/morrisjs/morris.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/counterup/jquery.counterup.min.js')); ?>"></script>

<!-- jQuery for carousel -->
<script src="<?php echo e(asset('plugins/bower_components/owl.carousel/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/owl.carousel/owl.custom.js')); ?>"></script>

<!--weather icon -->
<script src="<?php echo e(asset('plugins/bower_components/skycons/skycons.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>