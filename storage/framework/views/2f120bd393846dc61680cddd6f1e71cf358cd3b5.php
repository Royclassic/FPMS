

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
                <li><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                <li class="active">Documentations</li>
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
                        <h2>Project Documentation
                            <small><h6>All students final approved documentations by the lecturer</h6>
                            </small>
                        </h2>
                    </div>
                    <div class="card-body card-padding">
                        <table  class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="example" width="100%">
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Admission</th>
                                <th>Documentation</th>
                                <th>Supervisor</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($student->documentation!==null): ?>
                                    <?php if($student->documentation->final_documentation!==null && $student->documentation->status==1 ): ?>
                                        <tr>
                                            <td><?php echo e($student->user->name); ?></td>
                                            <td><?php echo e($student->user->admission_staff_no); ?></td>
                                            <td><?php echo e($student->documentation->final_documentation); ?></td>
                                            <td><?php echo e($student->supervisor->user->name); ?></td>
                                            <td>
                                                <a href="<?php echo e(URL::to('documentations/'.$student->user->email.'/'.$student->documentation->final_documentation)); ?>" target="_blank">
                                                    <button  type="button"  class="btn btn-success btn-xs " ><span class="zmdi zmdi-eye" ></span> View</button>
                                                </a>
                                                <a href="<?php echo e(URL::to('documentations/'.$student->user->email.'/'.$student->documentation->final_documentation)); ?>" target="_blank">
                                                    <button  type="button"  class="btn btn-success btn-xs " ><span class="zmdi zmdi-download" ></span> Download</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
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