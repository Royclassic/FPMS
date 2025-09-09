

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
                <li><a href="<?php echo e(route('student.dashboard.index')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('student.proposal.title')); ?>"><?php echo e($pageTitle); ?></a></li>
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

<?php if($proposal==null): ?>
    <form class="form-horizontal" role="form" action="<?php echo e(route('student.proposal.saveTitle')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

        <?php if(Session::has('message')): ?>
            <p class="alert alert-danger"><?php echo e(Session::get('message')); ?></p>
        <?php endif; ?>
        <?php if(!empty($warning)): ?>
            <p class="alert alert-danger"><?php echo e($warning); ?></p>
        <?php endif; ?>

        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Submit Your Project Title and the following repective fields</div>

                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">What is the title of the project you are proposing? <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control <?php echo e($errors->has('title') ? ' has-error' : ''); ?> " id="title"
                                                   name="title" required>
                                            <?php if($errors->has('title')): ?>
                                                <span class="help-block">
			                                        <strong><?php echo e($errors->first('title')); ?></strong>
                                              </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">What broad field or subject area are you interested in? e.g Expert Systems in Education<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control <?php echo e($errors->has('field') ? ' has-error' : ''); ?> " id="title"
                                                   name="field" required>
                                            <?php if($errors->has('field')): ?>
                                                <span class="help-block">
			                                        <strong><?php echo e($errors->first('field')); ?></strong>
                                              </span>
                                            <?php endif; ?>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label ">What Subareas are related to the broad field or subject area of your interest? In numbering. <span class="text-danger">*</span></label>
                                            <textarea class="textarea_editor form-control" rows="10" name="subareas"
                                                      id="subareas"></textarea>
                                            <?php if($errors->has('subareas')): ?>
                                                <span class="help-block">
			                                        <strong><?php echo e($errors->first('subareas')); ?></strong>
                                              </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">What Subarea is of most interest to you? e.g Elearning <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control  <?php echo e($errors->has('main_subarea') ? ' has-error' : ''); ?> " id="title"
                                                   name="main_subarea" required>
                                            <?php if($errors->has('main_subarea')): ?>
                                                <span class="help-block">
			                                        <strong><?php echo e($errors->first('main_subarea')); ?></strong>
                                              </span>
                                            <?php endif; ?>
                                        </div>
                                    </div> -->
                                    <!--/span-->

                                </div>
                                <!--/row-->

                            </div>
                        </div>

                        <div class="panel-footer text-right">
                            <div class="btn-group dropup">
                                <button class="btn btn-success" type="submit"><?php echo app('translator')->getFromJson('app.submit'); ?></button>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <!-- .row -->
        </div>

    </form>
<?php else: ?>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12" style="padding-left: 30px!important;">
            <div class="white-box">
                <div class="#">
                    <?php if(Session::has('message')): ?>
                        <p class="alert alert-danger"><?php echo e(Session::get('message')); ?></p>
                    <?php endif; ?>
                    <div class="t-view" data-tv-type="text">
                        <div class="tv-header media">
                            <?php if(Auth::user()->image==null): ?>
                                <a href="" class="tvh-user pull-left">
                                    <img class="img-responsive" src="<?php echo e(URL::to('default-profile-2.png')); ?>" alt="">
                                </a>
                            <?php else: ?>
                                <a href="" class="tvh-user pull-left">
                                    <img class="img-responsive" src="<?php echo e(URL::to('profile/'. $user->image)); ?>" alt="">
                                </a>
                            <?php endif; ?>

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
                                        <h2><i class="zmdi zmdi-wrap-text m-r-10"></i>Proposal Title</h2>

                                    </div>
                                    <div class="pmbb-body p-l-30">

                                        <div class="pmbb-view">
                                            <!-- <dl class="dl-horizontal">
                                                <dt>Main Field</dt>
                                                <dd><?php echo e($proposal->field); ?></dd>
                                            </dl> -->
                                            <dl class="dl-horizontal">
                                                <dt>Sub-areas</dt>
                                                <dd><?php echo $proposal->subareas; ?></dd>
                                            </dl>
                                            <!-- <dl class="dl-horizontal">
                                                <dt>Main Area of Intrest</dt>
                                                <dd><?php echo $proposal->main_subarea; ?></dd>
                                            </dl> -->
                                            <dl class="dl-horizontal">
                                                <dt>Title</dt>
                                                <dd><?php echo $proposal->title->title; ?></dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt>Status</dt>
                                                <?php if($proposal->title->status==0): ?>
                                                    <dd><button class="btn btn-warning btn-xs">Approval Pending</button></dd>
                                                <?php elseif($proposal->title->status==2): ?>
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
                                <?php $__empty_1 = true; $__currentLoopData = $proposal->title->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="media">
                                        <?php if($review->user->image==null): ?>
                                            <a href="" class="tvh-user pull-left">
                                                <img class="img-responsive" src="<?php echo e(URL::to('default-profile-2.png')); ?>" alt="">
                                            </a>
                                        <?php else: ?>
                                            <a href="" class="tvh-user pull-left">
                                                <img class="img-responsive" src="<?php echo e(URL::to('profile/'.$review->user->image)); ?>" alt="">
                                            </a>
                                        <?php endif; ?>
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
                                <form action="<?php echo e(route('student.title.reply')); ?>" method="POST">
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
                        <button type="submit" onclick="return titleEdit('<?php echo e($proposal->title->id); ?>')"
                                class="btn btn-primary  btn-sm">Change Title
                        </button>
                    </div>

                    <form style="visibility: hidden" method="POST" action="<?php echo e(route('student.title.edit',$proposal->title->id)); ?>" id="<?php echo e($proposal->title->id); ?>">
                        <?php echo e(csrf_field()); ?>

                    </form>
                </div>
            </div>

        </div>
    </div>

         <div class="modal fade" id="editTitle" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="lineModalLabel">Edit Title</h3>
                    </div>
                    <div class="modal-body">

                        <!-- content goes here -->
                        <form id="updateform" method="POST" action="<?php echo e(route('student.title.edit')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group" >
                                <label for="title" class="col-sm-12 control-label" style="text-align: left;"><b>What is the title of the project you are proposing?</b></label>
                                <div class="col-sm-12">
                                    <div class="fg-line">
                                        <input type="text" class="form-control input-sm"
                                               name="title" required>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="field" class="col-sm-12 control-label" style="text-align: left;"><b>What broad field or subject area are you interested in?</b></label>
                                <div class="col-sm-12">
                                    <div class="fg-line">
                                        <input type="text" class="form-control" name="field"  required>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label for="subarea" class="col-sm-12 control-label" style="text-align: left;"><b>What Subareas are related to the broad field or subject area of your interest? In numbering.</b></label>
                                <div class="col-sm-12">
                                    <div class="fg-line">
                                        <textarea class="form-control " name="subareas"  required></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="password" class="col-sm-12 control-label" style="text-align: left;"><b>What Subarea is of most interest to you?</b></label>
                                <div class="col-sm-12">
                                    <div class="fg-line">
                                        <input type="text" class="form-control" name="main_subarea"  required>
                                    </div>
                                </div>
                            </div> -->
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
    <script>
        $('.textarea_editor').wysihtml5();

    </script>
    <script type="text/javascript">

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
                var submiturl="<?php echo e(URL::to('student/proposal/title/edit')); ?>";
                $.ajax({
                    url:submiturl+ '/' +id,
                    type:'GET',
                    data:'',
                    success:function (data) {
                        console.log(data)
                        $("input[name='title']").val(data.title);
                        $("input[name='field']").val(data.field);
                        $("input[name='main_subarea']").val(data.main_subarea)
                        $("textarea[name='subareas']").summernote('code',data.subareas);
                    },
                    error: function (xhr) {
                        console.log("xhr=" + xhr);

                    }

                })
                $('#editTitle').modal('show')
            }
        });
        //document.getElementById(id).submit();


    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.client-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>