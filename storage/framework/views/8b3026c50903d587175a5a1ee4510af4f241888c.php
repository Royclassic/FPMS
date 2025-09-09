

<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> Overview</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('student.dashboard.index')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('student.files.index')); ?>">Files</a></li>
                <li class="active">Overview</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/icheck/skins/all.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/multiselect/css/multi-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">

            <section>
                <div class="sttabs tabs-style-line">
                    <div class="white-box">
                        <nav>
                            <ul>
                                <li class="tab-current"><a  href="<?php echo e(route('student.files.overview')); ?>"><span>Overview</span></a>
                                </li>
                                <li ><a href="<?php echo e(route('student.files.index')); ?>"><span>Codes</span></a> </li>>
                            </ul>
                        </nav>
                    </div>
                    <div class="content-wrap">
                        <section id="section-line-1" class="show">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white-box">
                                        <h3 class="b-b"> <span
                                                    class="font-bold"><?php echo e(ucwords($proposal->title->title)); ?></span>
                                        </h3>

                                        <div>
                                            <p>Upload your project files in this section, files can be uploaded individually or as zipped documents</p>
                                            <p>Make sure you also project manual and installation instructions</p>
                                            <p>Database connections with credentials should also be specified</p>

                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">

                                        
                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Supervisor</div>
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                           <dl>
                                                                    <dt>Name</dt>
                                                                    <dd class="m-b-10"><?php echo e($proposal->student->supervisor->user->name); ?></dd>

                                                           </dl>
                                                            <dl>
                                                                <dt>Email</dt>
                                                                <dd class="m-b-10"><?php echo e($proposal->student->supervisor->user->email); ?></dd>
                                                            </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Proposal</div>
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <dl>
                                                            <dt>Field</dt>
                                                            <dd class="m-b-10"><?php echo e($proposal->field); ?></dd>

                                                        </dl>
                                                        <dl>
                                                            <dt>Area</dt>
                                                            <dd class="m-b-10"><?php echo e($proposal->main_subarea); ?></dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Status</div>
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <dl>
                                                            <dt>Proposed on</dt>
                                                            <dd class="m-b-10"><?php echo e(Carbon\Carbon::parse($proposal->created_on)->toDayDateTimeString()); ?></dd>

                                                        </dl>
                                                        <dl>
                                                            <dt>Status</dt>
                                                            <?php if($proposal->status==1): ?>
                                                            <dd class="m-b-10">Approved</dd>
                                                            <?php else: ?>
                                                             <dd class="m-b-10">Pending</dd>
                                                            <?php endif; ?>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div><!-- /content -->
                </div><!-- /tabs -->
            </section>
        </div>


    </div>
    <!-- .row -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('js/cbpFWTabs.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/multiselect/js/jquery.multi-select.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.client-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>