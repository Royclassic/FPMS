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
                <li><a href="<?php echo e(route('supervisor.dashboard')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e($pageTitle); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="row row-in">
                    <div class="col-lg-3 col-sm-6 row-in-br">
                        <div class="col-in row">
                            <h3 class="box-title"><?php echo app('translator')->getFromJson('modules.dashboard.totalProjects'); ?></h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-layers text-info"></i></li>
                                <li class="text-right"><span class="counter"><?php echo e($students->count()); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6  row-in-br">
                        <div class="col-in row">
                            <h3 class="box-title">Total Students</h3>
                            <ul class="list-inline two-part">
                                <li><i class="ti-user text-info"></i></li>
                                <li class="text-right"><span class="counter"><?php echo e($students->count()); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 b-0">
                        <div class="col-in row">
                            <h3 class="box-title">Logs</h3>
                            <ul class="list-inline two-part">
                                <li><i class="ti-time text-success"></i></li>

                                <li class="text-right"><span class="counter"><?php echo e($students->count()); ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="row row-in">

                    <div class="col-lg-3 col-sm-6  row-in-br">
                        <div class="col-in row">
                            <h3 class="box-title">Proposals</h3>
                            <ul class="list-inline two-part">
                                <li><i class="ti-layers text-info"></i></li>
                                <li class="text-right"><span class="counter"><?php echo e($students->count()); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 b-0">
                        <div class="col-in row">
                            <h3 class="box-title">Documentations</h3>
                            <ul class="list-inline two-part">
                                <li><i class="ti-files text-success"></i></li>
                                <li class="text-right"><span class="counter"><?php echo e($students->count()); ?></span></li>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.member-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>