<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-doc"></i> Proposal Assessment</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('supervisor.dashboard')); ?>">Home</a></li>
                <li class="active">Proposal Assessment</li>
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
    <div class="row">
        <div class="col-md-12" style="padding-left: 30px !important;">
            <div class="white-box">
                    <div class="t-view" data-tv-type="text">
                        <div class="tv-header media">
                            <a href="" class="tvh-user pull-left">
                                <?php if($student->image==null): ?>
                                    <img class="img-responsive" src="<?php echo e(URL::to('default-profile-2.png')); ?>" alt="">
                                <?php else: ?>
                                    <img class="img-responsive" src="<?php echo e(URL::to('profile/'. $student->image)); ?>" alt="">
                                <?php endif; ?>
                            </a>
                            <div class="media-body p-t-5">
                                <strong class="d-block"><?php echo e($student->name); ?></strong>
                                <small class="c-gray"><?php echo e($student->admission_staff_no); ?></small>
                            </div>
                        </div>
                        <div class="pm-body clearfix">
                            <div class="pmb-block ">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-wrap-text m-r-10"></i>Project Proposal</h2>
                                </div>
                                <div class="pmbb-body p-l-30">
                                    <?php if($errors->any()): ?>
                                        <div class="alert alert-danger">
                                            <ul>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($error); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                    <div class="pmbb-view">
                                        <dl class="dl-horizontal">
                                            <dt>Field</dt>
                                            <dd>
                                                <?php echo e($proposal->field); ?>

                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Sub area</dt>
                                            <dd>
                                                <?php echo e($proposal->main_subarea); ?>

                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Proposal file</dt>
                                            <dd><?php echo e($proposal->file); ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="<?php echo e(URL::to('proposals/'.$proposal->file)); ?>" target="_blank">
                                                    <button class="btn btn-success btn-xs"><i class="zmdi zmdi-eye"></i> View</button>
                                                </a>
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Problem Statement</dt>
                                            <dd>
                                                <?php echo $proposal->problem->problem; ?>

                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Research Objectives</dt>
                                            <dd>
                                                <?php echo $proposal->objective->objectives; ?>

                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Research Questions</dt>
                                            <dd>
                                                <?php echo $proposal->objective->questions; ?>

                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Status</dt>
                                            <?php if($proposal->status==0): ?>
                                                <dd><button class="btn btn-warning btn-xs">Approval Pending</button></dd>
                                            <?php elseif($proposal->status==2): ?>
                                                <dd><button class="btn btn-danger btn-xs">Denied Approval</button></dd>
                                            <?php else: ?>
                                                <dd><button class="btn btn-success btn-xs">Approved</button></dd>
                                            <?php endif; ?>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Completed</dt>
                                            <dd>
                                                <?php if($proposal->completed==0): ?>
                                                    <button class="btn btn-warning btn-xs">Progressing</button>
                                                <?php else: ?>
                                                    <button class="btn btn-success btn-xs">Completed</button>
                                                <?php endif; ?>

                                            </dd>
                                        </dl>
                                        <?php if($proposal->remarks==null): ?>
                                            <dl class="dl-horizontal">
                                                <dt>Remarks</dt>
                                                <dd>
                                                    <form action="<?php echo e(route('supervisor.proposal.remark', $proposal->id)); ?>" method="POST">
                                                        <?php echo e(csrf_field()); ?>

                                                        <div>
                                                            <textarea class="form-control html-editor" placeholder="Write a remark..." name="remark"></textarea>
                                                        </div>

                                                        <button class="m-t-15 btn btn-primary btn-sm" type="submit">Submit</button>

                                                    </form>
                                                </dd>
                                            </dl>
                                        <?php endif; ?>
                                        <?php if($proposal->remarks==!null): ?>
                                            <dl class="dl-horizontal">
                                                <dt>Remarks</dt>
                                                <dd>
                                                    <?php echo $proposal->remarks; ?>

                                                </dd>
                                            </dl>
                                        <?php endif; ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class=" row text-center" >

                        <a href="<?php echo e(route('supervisor.proposals.assessment')); ?>">
                            <button  class="btn btn-primary  btn-sm">Done
                            </button>
                        </a>

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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.member-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>