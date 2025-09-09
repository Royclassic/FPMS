<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-user"></i> Student</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('admin.students.index')); ?>">Student</a></li>
                <li class="active">Student</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <link href="<?php echo e(URL::to('css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <div class="row">
                    <div class="col-xs-6 b-r"> <strong>Full Name</strong> <br>
                        <p class="text-muted"><?php echo e(ucwords($client->name)); ?></p>
                    </div>
                    <div class="col-xs-6"> <strong><?php echo app('translator')->getFromJson('app.mobile'); ?></strong> <br>
                        <p class="text-muted"><?php echo e(isset($client->phone) ? $client->phone : 'NA'); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-xs-6 b-r"> <strong><?php echo app('translator')->getFromJson('app.email'); ?></strong> <br>
                        <p class="text-muted"><?php echo e($client->email); ?></p>
                    </div>
                    <div class="col-md-3 col-xs-6"> <strong>Faculty</strong> <br>
                        <p class="text-muted"><?php echo e($client->faculty->faculty); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-xs-6 b-r"> <strong>Admission Number</strong> <br>
                        <p class="text-muted"><?php echo e($client->admission_staff_no); ?></p>
                    </div>
                    <div class="col-md-3 col-xs-6"> <strong>Course</strong> <br>
                        <p class="text-muted"><?php echo e(@$client->course->course); ?></p>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-12">

            <section>
                <div class="sttabs tabs-style-line">
                    <div class="white-box">
                        <nav>
                            <ul>
                                <li class="tab-current"><a href="<?php echo e(route('admin.students.projects', $client->id)); ?>"><span>Supervisor</span></a>
                            </ul>
                        </nav>
                    </div>
                    <?php if($supervisor!==null): ?>
                    <div class="col-md-12">
                        <div class="white-box">

                            <div class="row">
                                <div class="col-xs-6 b-r"> <strong>Supervisor</strong> <br>
                                    <p class="text-muted"><?php echo e(ucwords($supervisor->user->name)); ?></p>
                                </div>
                                <div class="col-xs-6"> <strong>Phone</strong> <br>
                                    <p class="text-muted"><?php echo e(isset($supervisor->user->phone) ? $supervisor->user->phone : 'NA'); ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-xs-6 b-r"> <strong><?php echo app('translator')->getFromJson('app.email'); ?></strong> <br>
                                    <p class="text-muted"><?php echo e($supervisor->user->email); ?></p>
                                </div>
                                <div class="col-md-3 col-xs-6"> <strong>Faculty</strong> <br>
                                    <p class="text-muted"><?php echo e($supervisor->user->faculty->faculty); ?></p>
                                </div>
                            </div>


                        </div>
                    </div><!-- /content -->
                    <?php else: ?>
                        <div class="col-md-12">
                            <div class="row">
                                <p class="container-fluid">Supervisor not Assigned</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div><!-- /tabs -->
            </section>
        </div>


    </div>
    <!-- .row -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>