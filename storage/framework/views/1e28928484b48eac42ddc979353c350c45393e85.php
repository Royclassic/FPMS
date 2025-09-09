

<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <h4 class="page-title"><i class="icon-doc"></i> Proposals Assessments</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-7 col-sm-7 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('supervisor.dashboard')); ?>">Home</a></li>
                <li class="active">Assessments</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('dataTables.bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/plugins/dataTables/responsive.bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/plugins/dataTables/buttons.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('css/app_1.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('css/app_3.min.css')); ?>">
    <link href="<?php echo e(URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="card">
                <div class="card-header">
                    <h2>Supervision area<small>Add your area of specialization for project supervision</small></h2>
                    <?php if(Session::has('message')): ?>
                        <p class="alert alert-danger"><?php echo e(Session::get('message')); ?></p>
                    <?php endif; ?>
                </div>
                <div class="card-body card-padding">
                    <div class="btn-demo">
                        <?php if($areas!=null): ?>
                            <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button class="btn btn-default btn-icon-text">
                                    <i class="zmdi zmdi-star-outline"></i>
                                    <?php echo e($area->supervision_area); ?>

                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <button class="btn btn-success btn-icon-text" id="location"><i class="zmdi zmdi-plus"></i>Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    <div class="modal fade" id="addSkill" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Supervision Area</h4>
                </div>
                <div class="modal-body">
                    <!-- content goes here -->
                    <form action="<?php echo e(route('supervisor.supervision.add')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label for="status">Area</label>
                            <input type="text" name="supervision_area" class="form-control" required id="skill">
                        </div>



                        <div class="modal-footer">

                            <button type="submit"   class="btn btn-primary btn-hover-green btn-sm pull-left" data-action="save" role="button" >Add</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>

                        </div>
                    </form>
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
    <script src="<?php echo e(URL::to('plugins/editor.js')); ?>"></script>
    <script type="text/javascript">
        $('#location').on('click', function (e) {
            e.preventDefault();
            $('#skill').val(' ')
            $('#addSkill').modal('show')
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.member-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>