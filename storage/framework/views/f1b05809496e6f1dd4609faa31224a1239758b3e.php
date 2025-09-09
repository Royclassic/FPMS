<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-layers"></i> Proposals</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('supervisor.dashboard')); ?>">Home</a></li>
                <li class="active">Proposals</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('dataTables.bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/plugins/dataTables/responsive.bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/plugins/dataTables/buttons.dataTables.min.css')); ?>">
    <link href="<?php echo e(URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="card">
                    <div class="card-header">
                        <h2>Final Students Proposals
                            <br>
                            <small><h6>Students who have finished their proposals and given green light by their supervisors</h6>
                            </small>
                        </h2>
                    </div>
                    <div class="card-body card-padding">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="example" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student</th>
                                    <th>Admission</th>
                                    <th>Field</th>
                                    <th>Title</th>
                                    <th>Proposal</th>
                                    <td>Supervisor</td>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $proposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$proposal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e(++$key); ?></th>
                                        <td><?php echo e($proposal->student->user->name); ?></td>
                                        <td><?php echo e($proposal->student->user->admission_staff_no); ?></td>
                                        <td><?php echo $proposal->field; ?></td>
                                        <td><?php echo e($proposal->title->title); ?></td>
                                        <td><?php echo e($proposal->file); ?></td>
                                        <td><?php echo e($proposal->student->supervisor->user->name); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.proposals.view', $proposal->id)); ?>">
                                                <button  type="button"  class="btn btn-primary btn-xs " ><span class="zmdi zmdi-check-all" ></span> View</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('plugins/dataTables/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('plugins/dataTables/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('plugins/dataTables/responsive.bootstrap.min.js')); ?>"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('#example').DataTable( {
                columnDefs: [ {
                    targets: [ 0 ],
                    orderData: [ 0, 1 ]
                }, {
                    targets: [ 1 ],
                    orderData: [ 1, 0 ]
                }, {
                    targets: [ ],
                    orderData: [ 4, 0 ]
                } ]
            } );
        } );

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>