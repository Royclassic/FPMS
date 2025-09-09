
<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> Supervisors</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('admin.supervisors.index')); ?>">Supervisors</a></li>
                <li class="active">Assign Students</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link href="<?php echo e(URL::to('css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"> Assign Students To Supervisors</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <?php if(Session::has('message')): ?>
                            <p class="alert alert-danger"><?php echo e(Session::get('message')); ?></p>
                        <?php endif; ?>
                        <table id="example" class="display" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>ADM</th>
                                <th>Course</th>
                                <th>Title</th>
                                <th>Area</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$key); ?></td>
                                    <td><?php echo e($student->user->name); ?></td>
                                    <td><?php echo e($student->user->admission_staff_no); ?></td>
                                    <td><?php echo e(@$student->user->course->course); ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-xs">Not Proposed</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-xs">Not Proposed</button>
                                    </td>
                                    <!--     <td hidden="hidden"><?php echo e($student->user->id); ?></td> -->
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm "
                                                onclick="return update('<?php echo e($student->user->id); ?>')"><span
                                                    class="zmdi zmdi-check"></span>Assign
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .row -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Assign Student to Supervisors</h4>
                </div>
                <div class="modal-body">
                    <!-- content goes here -->
                    <form action="<?php echo e(route('admin.assign')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label for="id">Supervisor</label>
                            <select name="supervisor_user_id" class="selectpicker form-control " data-live-search="true"
                                    required="required"
                                    id="supervisor">
                                
                                <?php $__currentLoopData = $supervisors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supervisor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($supervisor->id); ?>"><?php echo e($supervisor->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" disabled="disabled" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" disabled="disabled" class="form-control">
                        </div>
                        
                        
                        
                        
                        <input type="hidden" name="student_user_id" id="user_id">


                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary btn-hover-green btn-sm pull-left"
                                    data-action="save" role="button">Assign
                            </button>

                            <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close
                            </button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('js/jquery.dataTables.min.js')); ?>"></script>
    <script type="text/javascript">
        $('.select2').select2();
        $(document).ready(function () {
            $('#example').DataTable({
                columnDefs: [{
                    targets: [0],
                    orderData: [0, 1]
                }, {
                    targets: [1],
                    orderData: [1, 0]
                }, {
                    targets: [],
                    orderData: [4, 0]
                }]
            });
        });


        function update(id) {
            //alert(id);
            $("input[name='student_user_id']").val(id);
            $('#editModal').modal('show');
        }

        $("#supervisor").on('change', function () {
            //alert($(this).val());
            var id = $(this).val();

            $.get("<?php echo e(route('admin.showSupervisorInfo')); ?>", {id: id}, function (data) {
                console.log(data);
                $('#location').val(data.location);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('#clients').val(data.total_clients)
            })

        });


    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>