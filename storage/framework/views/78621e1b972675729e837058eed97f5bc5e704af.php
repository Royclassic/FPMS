<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> Project Logs</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('student.dashboard.index')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li><a class="active">Project Logs</a></li>
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
    <style>
        .lgi-attrs{
            list-style: none;
            padding: 5px 10px 6px;
            margin: 0;

        }
        .lgi-attrs li{
            border: 1px solid #ccc !important;
            border-color: #4CAF50!important;
            color: #4CAF50;;
        }
        .lgi-attrs li.lgi-approved{
            border-color: #FF9800!important;
            color:#FF9800 !important;
        }
        .lgi-attrs li.lgi-pending{
            border-color: #FF9800!important;
            color:#FF9800 !important;
        }
        .lgi-attrs li.lgi-completion{
            border-color: #03A9F4!important;
            color:#03A9F4 !important;
        }
        .
        .action-header{padding:25px 30px;line-height:100%;position:relative;z-index:1;min-height:65px;background-color:#F7F7F7}

    </style>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12" >
            <div class="white-box">
                <div class="card">

                    <div class="card-header">
                        <h2>Milestone
                            <small>Suggest tasks and milestones for various checkpoints</small>
                        </h2>
                    </div>
                    <?php if($now>$project_end): ?>
                        <div class="alert alert-danger">
                            <p>Your previously assigned task has hit its deadline, please contact your supervisor for an extension to be able to submit your next milestone</p>
                        </div>
                        <div class="card-body card-padding">
                            <div class="list-group lg-odd-black">
                                <div class="action-header clearfix">
                                    <div class="ah-label hidden-xs">Progress Logs</div>
                                    <ul class="actions">
                                        Deadline :<span style="color: #FFC107"><?php echo e(Carbon\Carbon::parse($project_end)->toDayDateTimeString()); ?></span>
                                        <li class="dropdown">
                                            <a href="#" data-toggle="dropdown" aria-expanded="true">
                                                <i class="zmdi zmdi-sort"></i>
                                            </a>

                                        </li>
                                    </ul>
                                </div>
                                <?php if(Session::has('warning')): ?>
                                    <p class="alert alert-warning"><?php echo e(Session::get('warning')); ?></p>
                                <?php endif; ?>
                                <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="list-group-item media">
                                        <div class="checkbox pull-left">
                                            <label>
                                                <input type="checkbox" value="">
                                                <i class="input-helper"></i>
                                            </label>
                                        </div>

                                        <div class="pull-right">
                                            <div class="actions dropdown">
                                                <a href="" data-toggle="dropdown" aria-expanded="true">
                                                    <i class="zmdi zmdi-more-vert"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="#" onclick="return milestoneEdit('<?php echo e($log->id); ?>')">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" onclick="return deleteMilestone('<?php echo e($log->id); ?>')">Delete</a>
                                                    </li>
                                                    <form action="<?php echo e(route('student.log.milestone.delete')); ?>" method="POST" id="<?php echo e($log->id); ?>" style="display: none;">
                                                        <?php echo e(csrf_field()); ?>

                                                        <input type="hidden" name="id" value="<?php echo e($log->id); ?>" >
                                                    </form>

                                                </ul>
                                            </div>
                                        </div>

                                        <div class="media-body">
                                            <div class="lgi-heading" style="overflow: auto;"><?php echo e($log->milestone); ?></div>
                                            <small class="lgi-text"><b>Supervisor additional :</b> <?php echo e($log->additional_tasks); ?>

                                            </small>
                                            <?php if($log->comments!==null): ?>
                                                <div class="list-group-item media" style="background-color: inherit!important;">
                                                    <div style="padding-left: 15px;">
                                                    </div>
                                                    <div class="pull-left">
                                                        <?php if(Auth::user()->student->supervisor->user->image==!null): ?>
                                                            <img class="lgi-img"
                                                                 src="<?php echo e(url('profile/'.Auth::user()->student->supervisor->user->image)); ?>"
                                                                 alt="">
                                                        <?php else: ?>
                                                            <img class="lgi-img" src="<?php echo e(URL::to('default-profile.jpg')); ?>" alt="">
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="media-body">
                                                        <div class="lgi-heading"><?php echo e(Auth::user()->student->supervisor->user->name); ?></div>
                                                        <small class="lg-hide-items"><?php echo e($log->comments); ?></small>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <ul class="lgi-attrs">
                                                <li class="f-500">Date Created: <?php echo e($log->created_at->toDayDateTimeString()); ?></li>
                                                <?php if($log->approved==1): ?>
                                                    <li class="f-500">Approved: Yes</li>
                                                <?php elseif($log->approved==0): ?>
                                                    <li class="f-500" style="color: yellow!important">Approved: Pending</li>
                                                <?php endif; ?>
                                                <li class="f-500">Assessed on : <?php echo e($log->updated_at->toDayDateTimeString()); ?> </li>
                                            </ul>
                                        </div>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                    <?php else: ?>
                        <div class="card-body card-padding">
                            <div class="list-group lg-odd-black">
                                <div class="action-header clearfix">
                                    <div class="ah-label hidden-xs">Progress Logs</div>

                                    
                                        

                                        

                                    

                                    <ul class="actions">
                                        Deadline :<span style="color: #FFC107"><?php echo e(Carbon\Carbon::parse($project_end)->toDayDateTimeString()); ?></span>
                                        <!-- <a href="<?php echo e(route('student.logs.print', $user->student->id)); ?>" style="color: darkgreen; font-size: 24px">
                                            <i style="color: darkgreen; font-size: 30px" class="zmdi zmdi-local-printshop"></i>
                                        </a> -->
                                    </ul>
                                </div>
                                <?php if(Session::has('warning')): ?>
                                    <p class="alert alert-warning"><?php echo e(Session::get('warning')); ?></p>
                                <?php endif; ?>
                                <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="list-group-item media">
                                        <div class="checkbox pull-left">
                                            <label>
                                                <input type="checkbox" value="">
                                                <i class="input-helper"></i>
                                            </label>
                                        </div>

                                        <div class="pull-right">
                                            <div class="actions dropdown">
                                                <a href="" data-toggle="dropdown" aria-expanded="true">
                                                    <i class="zmdi zmdi-more-vert"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="#" onclick="return milestoneEdit('<?php echo e($log->id); ?>')">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" onclick="return deleteMilestone('<?php echo e($log->id); ?>')">Delete</a>
                                                    </li>
                                                    <form action="<?php echo e(route('student.log.milestone.delete')); ?>" method="POST" id="<?php echo e($log->id); ?>" style="display: none;">
                                                        <?php echo e(csrf_field()); ?>

                                                        <input type="hidden" name="id" value="<?php echo e($log->id); ?>" >
                                                    </form>

                                                </ul>
                                            </div>
                                        </div>

                                        <div class="media-body">
                                            <div class="lgi-heading" style="overflow: auto;"><?php echo e($log->milestone); ?></div>
                                            <small class="lgi-text"><b>Supervisor additional :</b> <?php echo e($log->additional_tasks); ?>

                                            </small>
                                            <?php if($log->comments!==null): ?>
                                                <div class="list-group-item media" style="background-color: inherit!important;">
                                                    <div style="padding-left: 15px;">
                                                    </div>
                                                    <div class="pull-left">
                                                        <?php if(Auth::user()->student->supervisor->user->image==!null): ?>
                                                            <img class="lgi-img"
                                                                 src="<?php echo e(url('profile/'.Auth::user()->student->supervisor->user->image)); ?>"
                                                                 alt="">
                                                        <?php else: ?>
                                                            <img class="lgi-img" src="<?php echo e(url('default-profile.jpg')); ?>" alt="">
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="media-body">
                                                        <div class="lgi-heading"><?php echo e(Auth::user()->student->supervisor->user->name); ?></div>
                                                        <small class="lg-hide-items"><?php echo e($log->comments); ?></small>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <ul class="lgi-attrs">
                                                <li class="f-500">Date Created: <?php echo e($log->created_at->toDayDateTimeString()); ?></li>
                                                <?php if($log->approved==1): ?>
                                                    <li class="f-500">Approved: Yes</li>
                                                <?php elseif($log->approved==0): ?>
                                                    <li class="lgi-pending f-500" >Approved: Pending</li>
                                                <?php endif; ?>
                                                <li class="f-500">Assessed on : <?php echo e($log->updated_at->toDayDateTimeString()); ?> </li>
                                            </ul>
                                        </div>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                            <form class="form-horizontal" role="form" action="<?php echo e(route('student.logs.save')); ?>" method="POST"
                                  enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <label for="password" class="col-sm-12 control-label" style="text-align: left;"><b>What is the next milestone that you will be working on?</b></label>
                                    <div class="col-sm-12">
                                        <div class="fg-line<?php echo e($errors->has('milestone') ? ' has-error' : ''); ?>">
                                            <textarea class="form-control" name="milestone" id="sum" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-sm" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editTask" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Milestone</h4>
                </div>
                <div class="modal-body">
                    <!-- content goes here -->
                    <form action="<?php echo e(route('student.log.milestone.update')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="milestone_id">
                        <div class="form-group">
                            <label for="password" class="col-sm-12 control-label" style="text-align: left;"><b>Milestone</b></label>
                            <div class="col-sm-12">
                                <div class="fg-line<?php echo e($errors->has('milestone') ? ' has-error' : ''); ?>">
                                    <textarea class="form-control" name="milestone" id="sum" required></textarea>
                                </div>

                            </div>
                            <br><br>
                        </div>
                        <br>

                        <div class="modal-footer">

                            <button type="submit"   class="btn btn-primary btn-hover-green btn-sm pull-left" data-action="save" role="button" >Update</button>

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
    <script>
        $('.textarea_editor').wysihtml5();

    </script>
    <script type="text/javascript">

        function milestoneEdit(id) {
            swal({
                title: "Are you sure?",
                text: "You will have to wait for approval again!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Edit!",
                closeOnConfirm: true
            }, function (isConfirm) {

                if (isConfirm) {
                    var submiturl = "<?php echo e(URL::to('student/project/milestone/edit')); ?>";
                    $.ajax({
                        url: submiturl + '/' + id,
                        type: 'GET',
                        data: '',
                        success: function (data) {
                            console.log(data)
                            $("input[name='milestone_id']").val(data.id);
                            $("textarea[name='milestone']").val(data.milestone);
                        },
                        error: function (xhr) {
                            console.log("xhr=" + xhr);

                        }

                    })
                    $('#editTask').modal('show')
                }
            });
        }
        function deleteMilestone(id) {
            swal({
                title: "Are you sure?",
                text: "You are about to delete this milestone!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                closeOnConfirm: false
            }, function (isConfirm) {

                if (isConfirm) {
                    document.getElementById(id).submit();
                }
            });


        }

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.client-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>