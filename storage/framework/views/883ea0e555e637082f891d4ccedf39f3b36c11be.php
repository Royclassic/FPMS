

<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-docs"></i> Documentations</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('student.dashboard.index')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li><a class="active">Objectives</a></li>
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
        <?php if($documentation==null): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="card">
                            <form class="form-horizontal" role="form" action="<?php echo e(route('student.chapterOne.save')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <?php if(Session::has('message')): ?>
                                    <p class="alert alert-danger"><?php echo e(Session::get('message')); ?></p>
                                <?php endif; ?>
                                <div class="card-header">
                                    <h2>Documentation Upload
                                    </h2>
                                </div>

                                <div class="card-body card-padding">
                                    <?php if(!empty($warning)): ?>
                                        <p class="alert alert-danger"><?php echo e($warning); ?></p>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-12 control-label" style="text-align: left;">
                                            <b>Upload your Documentation Chapter one (Introduction). Only as pdf file</b>
                                        </label>
                                        <div class="col-sm-12">
                                            <div class="fg-line<?php echo e($errors->has('file') ? ' has-error' : ''); ?>">
                                                <input type="file" class="form-control" name="file"   required>
                                                <?php if($errors->has('file')): ?>
                                                    <span class="help-block">
                                            <strong style="color: #dc3545;"><?php echo e($errors->first('file')); ?></strong>
                                        </span>
                                                <?php endif; ?>
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
                                                        <dt>Documentation</dt>
                                                        <dd><?php echo e($documentation->chapterOne->file); ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <a href="<?php echo e(URL::to('documentations/'.$user->email.'/'.$documentation->chapterOne->file)); ?>" target="_blank">
                                                                <button class="btn btn-success btn-xs"><i class="zmdi zmdi-eye"></i> View</button>
                                                            </a>
                                                        </dd>
                                                    </dl>

                                                    <dl class="dl-horizontal">
                                                        <dt>Status</dt>
                                                        <?php if($documentation->chapterOne->status==0): ?>
                                                            <dd><button class="btn btn-warning btn-xs">Approval Pending</button></dd>
                                                        <?php elseif($documentation->chapterOne->status==2): ?>
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
                                    <a class="tvc-more" href="#"><i class="zmdi zmdi-mode-comment"></i> Supervisor Comments</a>
                                </div>
                                <div class="tv-comments">
                                    <ul class="tvc-lists">
                                        <?php if($documentation->chapterOne->comment!==null): ?>
                                            <li class="media">
                                                <a href="" class="tvh-user pull-left">
                                                    <?php if($documentation->student->supervisor->user->image==null): ?>
                                                        <img class="lgi-img" src="<?php echo e(URL::to('default-profile.jpg')); ?>" alt="">
                                                    <?php else: ?>
                                                        <img class="img-responsive" src="<?php echo e(URL::to('profile/'.Auth::user()->student->supervisor->user->image)); ?>" alt="">
                                                    <?php endif; ?>
                                                </a>
                                                <div class="media-body">
                                                    <strong class="d-block"><?php echo e(Auth::user()->student->supervisor->user->name); ?></strong>
                                                    <small class="c-gray"><?php echo e($documentation->chapterOne->updated_at->toDayDateTimeString()); ?></small>

                                                    <div class="m-t-10"><?php echo e($documentation->chapterOne->comment); ?>

                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <ul class="tvb-stats">
                                                        <?php if($documentation->chapterOne->completion==1): ?>
                                                            <li class="tvbs-comments"> Fully Completed</li>
                                                        <?php elseif($documentation->chapterOne->completion==2): ?>
                                                            <li class="tvbs-likes">Partially Completed</li>
                                                        <?php elseif($documentation->chapterOne->completion==3): ?>
                                                            <li class="tvbs-views">Not to standards</li>
                                                        <?php endif; ?>
                                                    </ul>

                                                </div>
                                            </li>
                                        <?php else: ?>
                                            <li class="media">
                                                <div class="media-body">
                                                    <div class="m-t-10" style="color: #dd7b0b">Your Chapter One Document has not been assessed at the moment</div>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class=" row text-center" >
                                <button type="submit"
                                        class="btn btn-primary  btn-sm" onclick="return problemEdit()">Edit Chapter One
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editProblem" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class="modal-title" id="lineModalLabel">Edit ChapterOne</h3>
                        </div>
                        <div class="modal-body">

                            <!-- content goes here -->
                            <form id="updateform" method="POST" action="<?php echo e(route('student.chapterOne.save')); ?>" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <label for="password" class="col-sm-12 control-label" style="text-align: left;">
                                        <b>Upload your Project Documentation ChapterOne. Only as pdf file</b>
                                    </label>
                                    <div class="col-sm-12">
                                        <div class="fg-line<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                            <input type="file" class="form-control" name="file" id="sum"  required>
                                            <br><br>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/bootstrap-wysihtml5.js')); ?>"></script>
    <script src="<?php echo e(URL::to('summernote/dist/summernote.js')); ?>"></script>
    <script src="<?php echo e(URL::to('plugins/editor.js')); ?>"></script>

    <script type="text/javascript">

        function problemEdit(id) {
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
                    var submiturl="<?php echo e(URL::to('student/proposal/problem/edit')); ?>";
                    $.ajax({
                        url:submiturl+ '/' +id,
                        type:'GET',
                        data:'',
                        success:function (data) {
                            console.log(data)
                            $("textarea[name='problem']").summernote('code',data.problem);
                        },
                        error: function (xhr) {
                            console.log("xhr=" + xhr);

                        }

                    })
                    $('#editProblem').modal('show')
                }
            });
            //document.getElementById(id).submit();


        }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>