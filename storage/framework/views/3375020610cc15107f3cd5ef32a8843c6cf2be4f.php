

<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-calender}"></i> Edit Task</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('student.dashboard.index')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('student.schedule')); ?>"><?php echo e($pageTitle); ?></a></li>
                <li class="active">Edit</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"> Update Task</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                       <form method="POST" action="<?php echo e(route('student.schedules.update', $schedule->id)); ?>">
                           <?php echo e(csrf_field()); ?>

                        <div class="form-body">
                            <h3 class="box-title m-t-40">Task Details</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label>Task Name</label>
                                        <input type="text" name="task_name" id="task_name" value="<?php echo e($schedule->task_name); ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start</label>
                                        <input type="date" name="start" id="start"  value="<?php echo e($schedule->start); ?>" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Duration /hour</label>
                                        <input type="number" name="duration" id="duration" value="<?php echo e($schedule->duration); ?>" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->

                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dependency</label>
                                        <select class="form-control selectpicker" multiple
                                                data-max-options="10" name="dependency[]">
                                            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($schedule->id); ?>"><?php echo e($schedule->task_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div> -->
                                <!--/span-->
                            </div>
                            <!--/row-->

                        </div>
                        <div class="form-actions">
                            <button type="submit" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> <?php echo app('translator')->getFromJson('app.update'); ?></button>
                            <a href="<?php echo e(route('student.schedule')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('app.back'); ?></a>
                        </div>
                        <form>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- .row -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>