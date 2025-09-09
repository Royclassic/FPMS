

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

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12" >
            <div class="white-box">
                <h2><?php echo app('translator')->getFromJson('app.menu.noticeBoard'); ?></h2>

                <ul class="list-group" id="issues-list">

                    <?php $__empty_1 = true; $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <h4><?php echo e(ucfirst($notice->heading)); ?></h4>
                                </div>
                                <div class="col-md-5 text-right">
                                    <span class="text-info"><?php echo e($notice->created_at->format('d M, y')); ?></span>
                                </div>
                            </div>

                            <div class="row m-t-20">
                                <div class="col-md-12">
                                    <?php echo e(nl2br($notice->description)); ?>

                                </div>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo app('translator')->getFromJson('messages.noNotice'); ?>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </div>
    <!-- .row -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.member-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>