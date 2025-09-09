

<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> Students Reports</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->getFromJson("app.menu.home"); ?></a></li>
                <li class="active">Students Reports</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/morrisjs/morris.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>



    <div class="white-box">
        <div class="row m-b-10">
            <h2>Filter Results</h2>
            <div class="col-md-4">
                
                   
                       
                
                <h5 class="box-title m-t-30">Select Report to generate</h5>
                <form method="POST" action="<?php echo e(route('admin.reports.students.generate')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2 form-control selectpicker" name="report">
                                    <option value="" selected >---------------Select--------------</option>
                                    <option value="all">All Students</option>
                                    <option value="active">Active Students</option>
                                    <option value="inactive">Inactive Students</option>

                                </select>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-success" ><i class="fa fa-check"></i> Generate
                </button>
            </div>
                </form>


        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>


<script src="<?php echo e(asset('plugins/bower_components/raphael/raphael-min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/morrisjs/morris.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>

<script>

    jQuery('#date-range').datepicker({
        toggleActive: true,
        format: 'yyyy-mm-dd'
    });

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>