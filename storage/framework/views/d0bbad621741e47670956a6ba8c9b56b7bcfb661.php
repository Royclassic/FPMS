

<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> Objectives</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('student.dashboard.index')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('student.proposal.title')); ?>">Objectives</a></li>
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
    <?php if($supervisor==null): ?>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="card">
                        <div class="card-header">
                            <h2>Supervisor Not Assigned</h2>
                        </div>
                        <div class="card-body card-padding">
                            <div class="alert alert-warning">
                                <p>Please wait for a supervisor to be assigned to you by the project coodinator</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <?php if($objective==null): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="card">
                            <form class="form-horizontal" role="form" action="<?php echo e(route('student.objectives.save')); ?>" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <?php if(Session::has('message')): ?>
                                    <p class="alert alert-danger"><?php echo e(Session::get('message')); ?></p>
                                <?php endif; ?>

                                <div class="card-header">
                                    <h2>Research Objectives<small>Research Objectives</small>
                                    </h2>
                                </div>

                                <div class="card-body card-padding">
                                    <?php if(!empty($warning)): ?>
                                        <p class="alert alert-danger"><?php echo e($warning); ?> </p>
                                    <?php endif; ?>
                                    <!-- <div class="form-group">
                                        <label for="password" class="col-sm-12 control-label" style="text-align: left;">
                                            <b>What research questions relate to your chosen subarea(s) and problem statement? State atleast five numbered research questions.</b>
                                        </label>
                                        <div class="col-sm-12">
                                            <div class="fg-line<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                                <textarea class="form-control html-editor" name="questions"   required></textarea>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="password" class="col-sm-12 control-label" style="text-align: left;">
                                            <b>What objectives relate to your reseaach area</b>
                                        </label>
                                        <div class="col-sm-12">
                                            <div class="fg-line<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                                <textarea class="form-control html-editor" name="objectives"   required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class=" col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-sm" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12" style="padding-left: 30px!important;">
                    <div class="white-box">
                        <div class="">


                            <?php if(Session::has('message')): ?>
                                <p class="alert alert-danger"><?php echo e(Session::get('message')); ?></p>
                            <?php endif; ?>
                            <div class="t-view" data-tv-type="text">
                                <div class="tv-header media">
                                    <a href="" class="tvh-user pull-left">
                                        <?php if($user->image==null): ?>
                                            <img class="img-responsive" src="<?php echo e(URL::to('default-profile.jpg')); ?>" alt="">
                                         <?php else: ?>
                                        <img class="img-responsive" src="<?php echo e(URL::to('profile/'. $user->image)); ?>" alt="">
                                         <?php endif; ?>
                                    </a>
                                    <div class="media-body p-t-5">
                                        <strong class="d-block"><?php echo e($user->name); ?></strong>
                                        <small class="c-gray"><?php echo e($user->admission_staff_no); ?></small>
                                    </div>
                                </div>
                                <div class="tv-body">
                                    <div class="clearfix"></div>

                                    <div class="clearfix"></div>
                                    <div class="pm-body clearfix">
                                        <!-- <div class="pmb-block ">
                                            <div class="pmbb-header">
                                                <h2><i class="zmdi zmdi-wrap-text m-r-10"></i>Research Questions</h2>
                                            </div>
                                            <div class="pmbb-body p-l-30">

                                                <div class="pmbb-view">
                                                    <dl class="dl-horizontal">
                                                        <dt>Questions</dt>
                                                        <dd><?php echo $objective->questions; ?></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="pmb-block ">
                                            <div class="pmbb-header">
                                                <h2><i class="zmdi zmdi-wrap-text m-r-10"></i>Research Objectives</h2>
                                            </div>
                                            <div class="pmbb-body p-l-30">

                                                <div class="pmbb-view">
                                                    <dl class="dl-horizontal">
                                                        <dt>Objectives</dt>
                                                        <dd><?php echo $objective->objectives; ?></dd>
                                                    </dl>

                                                    <dl class="dl-horizontal">
                                                        <dt>Status</dt>
                                                        <?php if($objective->status==0): ?>
                                                            <dd><button class="btn btn-warning btn-xs">Approval Pending</button></dd>
                                                        <?php elseif($objective->status==2): ?>
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
                                        <?php $__empty_1 = true; $__currentLoopData = $objective->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <li class="media">
                                                <a href="" class="tvh-user pull-left">
                                                    <?php if($review->user->image==null): ?>
                                                        <img class="img-responsive" src="<?php echo e(URL::to('default-profile.jpg')); ?>" alt="">
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
                                                    <div class="m-t-10" style="color: #dd7b0b">No reviews for <?php echo e($user->name); ?> at the moment</div>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <form action="<?php echo e(route('student.objective.reply')); ?>" method="POST">
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
                                <button type="submit"
                                        class="btn btn-primary btn-sm" onclick="return titleEdit('<?php echo e($objective->id); ?>') ">Edit Objectives
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editObjective" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class="modal-title" id="lineModalLabel">Edit Objectives</h3>
                        </div>
                        <div class="modal-body">

                            <!-- content goes here -->
                            <form id="updateform" method="POST" action="<?php echo e(route('student.objective.update')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <!-- <div class="form-group">
                                    <label for="subarea" class="col-sm-12 control-label" style="text-align: left;">
                                        <b>What research questions relate to your chosen subarea(s) and problem statement? State atleast five numbered research questions.</b></label>
                                    <div class="col-sm-12">
                                        <div class="fg-line">
                                            <textarea class="form-control " name="questions"  required></textarea>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label for="subarea" class="col-sm-12 control-label" style="text-align: left;">
                                        <b>What objectives relate to your reseaach area</b></label>
                                    <div class="col-sm-12">
                                        <div class="fg-line">
                                            <textarea class="form-control " name="objectives"  required></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                <div class="btn-group" role="group">
                                    <button type="submit"   class="btn btn-primary btn-hover-green" data-action="save" role="button">Update</button>
                                </div>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/bootstrap-wysihtml5.js')); ?>"></script>
    <script src="<?php echo e(URL::to('summernote/dist/summernote.js')); ?>"></script>
    <script src="<?php echo e(URL::to('plugins/editor.js')); ?>"></script>

    <script type="text/javascript">{
            //$('#editor').summernote();

            function titleEdit(id) {
                swal({
                    title: "Are you sure?",
                    text: "You will have to re-propose again!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Edit!",
                    closeOnConfirm: true
                }, function(isConfirm){

                    if (isConfirm) {
                        var submiturl="<?php echo e(URL::to('student/proposal/objectives/edit')); ?>";
                        $.ajax({
                            url:submiturl+ '/' +id,
                            type:'GET',
                            data:'',
                            success:function (data) {
                                $("textarea[name='questions']").summernote('code',data.questions);
                                $("textarea[name='objectives']").summernote('code',data.objectives);
                            },
                            error: function (xhr) {
                                console.log("xhr=" + xhr);

                            }

                        })
                        $('#editObjective').modal('show')
                    }
                });
                //document.getElementById(id).submit();


            }
        }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>