

<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-lock"></i> Update Password</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li class="active">Update Profile</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/morrisjs/morris.css')); ?>"><!--Owl carousel CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/owl.carousel/owl.carousel.min.css')); ?>"><!--Owl carousel CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/owl.carousel/owl.theme.default.css')); ?>"><!--Owl carousel CSS -->
    <link rel="stylesheet" href="<?php echo e(URL::to('css/app_1.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('css/app_3.min.css')); ?>">
    <link href="<?php echo e(URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

    <style>
        .col-in{
            padding: 0 20px !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <style type="text/css">
                    #profile-main{
                        min-height: 470px;
                        max-height: inherit;
                    }
                    #clearfix{
                        min-width: 470px;
                    }

                    #center{
                        min-height: 400px;
                        max-height: 400px;
                        max-width: 400px;
                        min-width: 400px;
                    }
                    #pic{
                        min-height: 300px;
                        max-height: 300px;
                    }
                    #f-menu{
                        display: inline-block;

                        padding-left: 0;
                        margin-left: -5px;
                        margin-top: 5px;
                        list-style: none;
                    }
                    #f-menu li{
                        display: inline-block;
                        padding-left: 5px;
                        padding-right: 5px;

                    }

                </style>
                <div class="container container-alt ">

                    <div class="block-header">
                        <h2><?php echo e($user->name); ?>

                            <small> <?php echo e($user->admission_staff_no); ?> </small>
                        </h2>
                    </div>

                    <div class="card col-md-3 profile" id="profile-main" >
                        <div class="pm-overview c-overflow">
                            <div class="pmo-pic" >
                                <div class="p-relative"  >
                                    <a href="#">

                                        <?php if(Auth::user()->image===null): ?>
                                                <img src="<?php echo e(url('default-profile.jpg')); ?>" alt="">
                                        <?php else: ?>
                                            <img id="pic" class="img-responsive" src="<?php echo e(URL::to('/profile/'. $user->image)); ?>" alt="">
                                        <?php endif; ?>

                                    </a>

                                    <a href="#" id="photo"   class="pmop-edit"  >
                                        <i class="zmdi zmdi-camera"></i> <span   class="hidden-xs">Update Profile Picture</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="pm-body clearfix col-md-9" id="clearfix">
                        <div class="container container-alt">
                            <div class="card" id="profile-main" >

                                <div class="pm-body clearfix">
                                    <div class="pmb-block ">
                                        <div class="pmbb-header">
                                            <h2><i class="zmdi zmdi-account m-r-10"></i> Basic Information</h2>

                                            <ul class="actions">
                                                <li class="dropdown">
                                                    <a href="" data-ma-action="profile-edit" >
                                                        <button class="btn btn-success btn-icon"><i class="zmdi zmdi-edit"></i></button>
                                                    </a>

                                                </li>
                                            </ul>
                                        </div>
                                        <div class="pmbb-body p-l-30">

                                            <div class="pmbb-view">
                                                <dl class="dl-horizontal">
                                                    <dt>Full Names</dt>
                                                    <dd><?php echo e($user->name); ?></dd>
                                                </dl>
                                                <dl class="dl-horizontal">
                                                    <dt>Staff Number</dt>
                                                    <dd><?php echo e($user->admission_staff_no); ?></dd>
                                                </dl>

                                                <dl class="dl-horizontal">
                                                    <dt>Gender</dt>
                                                    <dd><?php echo e($user->gender); ?></dd>
                                                </dl>
                                            </div>
                                            <form method="POST" action="<?php echo e(route('student.updateBasic')); ?>">
                                                <?php echo e(csrf_field()); ?>

                                                <div class="pmbb-edit">
                                                    <dl class="dl-horizontal">
                                                        <dt class="p-t-10">Full Names</dt>
                                                        <dd>
                                                            <div class="fg-line">
                                                                <input type="text" name="name" class="form-control"
                                                                       value="<?php echo e($user->name); ?>">
                                                            </div>

                                                        </dd>
                                                    </dl>
                                                    <dl class="dl-horizontal">
                                                        <dt class="p-t-10">Staff Number</dt>
                                                        <dd>
                                                            <div class="fg-line">
                                                                <input type="text" name="admission_staff_no" class="form-control "
                                                                       value="<?php echo e($user->admission_staff_no); ?>" >
                                                            </div>

                                                        </dd>
                                                    </dl>
                                                    <dl class="dl-horizontal">
                                                        <dt class="p-t-10">Gender</dt>
                                                        <dd>
                                                            <div class="fg-line">
                                                                <select class="form-control selectpicker" name="gender">
                                                                    <?php if($user->gender=='Male'): ?>
                                                                        <option selected="selected" value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    <?php elseif($user->gender=='Female'): ?>
                                                                        <option selected="selected" value="Female">Female</option>
                                                                        <option value="Male"> Male</option>
                                                                    <?php else: ?>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    <?php endif; ?>

                                                                </select>
                                                            </div>
                                                        </dd>
                                                    </dl>



                                                    <div class="m-t-30">
                                                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                                        <button data-ma-action="profile-edit-cancel" class="btn btn-link btn-sm">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="pmb-block">
                                        <div class="pmbb-header">
                                            <h2><i class="zmdi zmdi-phone m-r-10"></i> Contact Information</h2>

                                            <ul class="actions">
                                                <li class="dropdown">
                                                    <a href="" data-ma-action="profile-edit">
                                                        <button class="btn btn-xs btn-success  btn-icon"><i class="zmdi zmdi-edit"></i></button>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="pmbb-body p-l-30">
                                            <div class="pmbb-view">
                                                <dl class="dl-horizontal">
                                                    <dt>Mobile Phone</dt>
                                                    <dd><?php echo e($user->phone); ?></dd>
                                                </dl>
                                                <dl class="dl-horizontal">
                                                    <dt>Email Address</dt>
                                                    <dd><?php echo e($user->email); ?></dd>
                                                </dl>

                                            </div>
                                            <form method="POST" action="<?php echo e(route('student.updateContact')); ?>">
                                                <?php echo e(csrf_field()); ?>

                                                <div class="pmbb-edit">
                                                    <dl class="dl-horizontal">
                                                        <dt class="p-t-10">Mobile Phone</dt>
                                                        <dd>
                                                            <div class="fg-line">
                                                                <input type="text" class="form-control input-mask" name="phone"
                                                                       value="<?php echo e($user->phone); ?>" data-mask="+254700000000">
                                                            </div>
                                                        </dd>
                                                    </dl>
                                                    <dl class="dl-horizontal">
                                                        <dt class="p-t-10">Email Address</dt>
                                                        <dd>
                                                            <div class="fg-line">
                                                                <input type="email" class="form-control" name="email"
                                                                       value="<?php echo e($user->email); ?>">
                                                            </div>
                                                        </dd>
                                                    </dl>

                                                    <div class="m-t-30">
                                                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                                        <button data-ma-action="profile-edit-cancel" class="btn btn-link btn-sm">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="updatePhoto" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                <h3 class="modal-title" id="lineModalLabel">Edit Photo</h3>
                            </div>
                            <div class="modal-body">

                                <!-- content goes here -->
                                <form id="updateform" method="POST" action="<?php echo e(route('student.updatephoto')); ?>" enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>

                                    <div  class="center" style="text-align: center">
                                        <div class="fileinput fileinput-new " data-provides="fileinput">
                                            <div id="center" class="fileinput-preview thumbnail " data-trigger="fileinput"></div>
                                            <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        
                                        <input type="file" name="image">
                                    </span>
                                                <a href="#" class="btn btn-danger fileinput-exists"
                                                   data-dismiss="fileinput">Remove</a>
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


            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/wysihtml5-0.3.0.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/bootstrap-wysihtml5.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/html5-editor/bootstrap-wysihtml5.js')); ?>"></script>
    <script src="<?php echo e(URL::to('plugins/bower_components/Waves/dist/waves.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('summernote/dist/summernote.js')); ?>"></script>
    <script src="<?php echo e(URL::to('plugins/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('plugins/editor.js')); ?>"></script>
    <script src="<?php echo e(URL::to('js/profile.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')); ?>"></script>
    <script type="text/javascript">

        $('#photo').on('click', function (e) {
            e.preventDefault()
            $('#updatePhoto').modal('show');


        })
    </script>
    <script type="text/javascript">
        function dateDeadline() {
            $('#deadlineInput').datetimepicker({
                format: 'YYYY-MM-DD h:mm A'
            });
        }
        function  addDeadline(id) {
            $("input[name='id']").val(id);
            $('#deadlineModal').modal('show');
        }

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.client-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>