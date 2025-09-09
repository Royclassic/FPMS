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
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e($pageTitle); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="row row-in">
                    <div class="col-lg-3 col-sm-6 row-in-br">
                        <div class="col-in row">
                            <h3 class="box-title"><?php echo app('translator')->getFromJson('modules.dashboard.totalProjects'); ?></h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-layers text-info"></i></li>
                                <li class="text-right"><span class="counter">1</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Project Supervisor</div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="steamline">
                                        <?php if($user->student->supervisor): ?>
                                            <div class="sl-item">
                                                <?php if($user->student->supervisor->user->image==null): ?>
                                                <div class="sl-left">
                                                  <img src="<?php echo e(asset('default-profile.jpg')); ?>" alt="supervisor" height="30" width="30" class="img-circle">
                                                </div>
                                                <?php else: ?>
                                                <div class="sl-left">
                                                    <img src="<?php echo e(asset('profile/'. $user->student->supervisor->user->image)); ?>" alt="supervisor" height="30" width="30" class="img-circle">
                                                </div>
                                                <?php endif; ?>
                                                <div class="sl-right">
                                                    <div class="m-l-40">
                                                        <a href="<?php echo e(route('student.supervisor.show')); ?>" class="text-success"><?php echo e(ucwords($user->student->supervisor->user->name)); ?></a>
                                                        <span  class="sl-date"><?php echo e($user->student->updated_at->diffForHumans()); ?></span>
                                                        <p>Email : <?php echo e($user->student->supervisor->user->email); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                      <?php else: ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>