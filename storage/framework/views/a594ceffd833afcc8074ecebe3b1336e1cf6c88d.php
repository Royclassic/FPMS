<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-doc"></i> Problem Review</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('supervisor.dashboard')); ?>">Home</a></li>
                <li class="active">Problem Review</li>
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
    <div class="col-md-12" style="padding-left: 30px !important;">
        <div class="white-box">
            <div class="">
                <div class="t-view" data-tv-type="text">
                    <div class="tv-header media">
                        <a href="" class="tvh-user pull-left">
                            <?php if($problem->proposal->student->user->image==null): ?>
                                <img class="img-responsive" src="<?php echo e(URL::to('default-profile-2.png')); ?>" alt="">
                            <?php else: ?>
                                <img class="img-responsive" src="<?php echo e(URL::to('profile/'. $problem->proposal->student->user->image)); ?>" alt="">
                            <?php endif; ?>
                        </a>
                        <div class="media-body p-t-5">
                            <strong class="d-block"><?php echo e($problem->proposal->student->user->name); ?></strong>
                            <small class="c-gray"><?php echo e($problem->proposal->student->user->admission_staff_no); ?></small>
                        </div>
                    </div>
                    <div class="tv-body">
                        <div class="clearfix"></div>

                        <div class="clearfix"></div>
                        <div class="pm-body clearfix">
                            <div class="pmb-block ">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-wrap-text m-r-10"></i>Proposal Problem Statement</h2>
                                </div>
                                <div class="pmbb-body p-l-30">

                                    <div class="pmbb-view">
                                        <dl class="dl-horizontal">
                                            <dt>Problem</dt>
                                            <dd><?php echo $problem->problem; ?></dd>
                                        </dl>

                                        <dl class="dl-horizontal">
                                            <dt>Status</dt>
                                            <?php if($problem->status==0): ?>
                                                <dd><button class="btn btn-warning btn-xs">Approval Pending</button></dd>
                                            <?php elseif($problem->status==2): ?>
                                                <dd><button class="btn btn-danger btn-xs">Denied Approval</button></dd>
                                            <?php else: ?>
                                                <dd><button class="btn btn-success btn-xs">Approved</button></dd>
                                            <?php endif; ?>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <a class="tvc-more" href=""><i class="zmdi zmdi-mode-comment"></i> Supervisor Reviews</a>
                    </div>

                    <div class="tv-comments">
                        <ul class="tvc-lists">
                            <?php $__empty_1 = true; $__currentLoopData = $problem->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li class="media">
                                    <a href="" class="tvh-user pull-left">
                                        <?php if($review->user->image==null): ?>
                                            <img class="img-responsive" src="<?php echo e(URL::to('default-profile-2.png')); ?>" alt="">
                                        <?php else: ?>
                                             <img class="img-responsive" src="<?php echo e(URL::to('profile/'.$review->user->image)); ?>" alt="">
                                        <?php endif; ?>
                                    </a>
                                    <div class="media-body">
                                        <strong class="d-block"><?php echo e($review->user->name); ?></strong>
                                        <small class="c-gray"><?php echo e($review->created_at->toDayDateTimeString()); ?></small>

                                        <div class="m-t-10"><?php echo e($review->review); ?>

                                        </div>

                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="m-t-10" style="color: #dd7b0b">No reviews for <?php echo e($student->name); ?> at the moment</div>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <form action="<?php echo e(route('supervisor.problem.review', $problem->id)); ?>" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <li class="p-20">
                                    <div class="fg-line">
                                        <textarea class="form-control auto-size" placeholder="Write a reply..." name="review"></textarea>
                                    </div>

                                    <button class="m-t-15 btn btn-primary btn-sm" type="submit">Reply</button>
                                </li>
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class=" row text-center" >
                    <?php if($problem->status==0): ?>
                        <a href="<?php echo e(route('supervisor.problem.approve', $problem->id)); ?>">
                            <button  class="btn btn-primary  btn-sm">Accept
                            </button>
                        </a>
                        <a href="<?php echo e(route('supervisor.problem.disapprove', $problem->id)); ?>">
                            <button  class="btn btn-warning  btn-sm">Reject
                            </button>
                        </a>
                    <?php elseif($problem->status==1): ?>
                        <a href="<?php echo e(route('supervisor.problem.disapprove', $problem->id)); ?>">
                            <button  class="btn btn-warning  btn-sm">Reject Problem Statement
                            </button>
                        </a>
                    <?php elseif($problem->status==2): ?>
                        <a href="<?php echo e(route('supervisor.problem.approve', $problem->id)); ?>">
                            <button  class="btn btn-primary  btn-sm">Approve Problem Statement
                            </button>
                        </a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.member-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>