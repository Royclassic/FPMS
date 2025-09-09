

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
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->getFromJson("app.menu.home"); ?></a></li>
                <li><a href="<?php echo e(route('admin.notices.index')); ?>"><?php echo e($pageTitle); ?></a></li>
                <li class="active"><?php echo app('translator')->getFromJson('app.edit'); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"> <?php echo app('translator')->getFromJson('modules.notices.updateNotice'); ?></div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <?php echo Form::open(['id'=>'updateNotice','class'=>'ajax-form','method'=>'PUT']); ?>


                        <div class="form-body">
                            <div class="row">
                                <div class="col-xs-12 ">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->getFromJson("modules.notices.noticeHeading"); ?></label>
                                        <input type="text" name="heading" id="heading"  class="form-control" value="<?php echo e($notice->heading); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/row-->

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->getFromJson("modules.notices.noticeDetails"); ?></label>
                                        <textarea name="description" id="description" rows="5" class="form-control"><?php echo e($notice->description); ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <!--/span-->

                        </div>
                        <div class="form-actions">
                            <button type="submit" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> <?php echo app('translator')->getFromJson('app.update'); ?></button>
                            <button type="reset" class="btn btn-default"><?php echo app('translator')->getFromJson('app.reset'); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- .row -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<script>

    $('#save-form').click(function () {
        $.easyAjax({
            url: '<?php echo e(route('admin.notices.update', [$notice->id])); ?>',
            container: '#updateNotice',
            type: "POST",
            redirect: true,
            data: $('#updateNotice').serialize()
        })
    });
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>