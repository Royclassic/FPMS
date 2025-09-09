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
                <li class="active">Add New Supervisor</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"> Add Supervisor Info</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <?php echo Form::open(['id'=>'createEmployee','class'=>'ajax-form','method'=>'POST']); ?>

                        <div class="form-body">
                            <h3 class="box-title m-t-40">Supervisor Details</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label>Supervisor Name</label>
                                        <input type="text" name="name" id="name"  class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Staff Number</label>
                                        <input type="text" name="admission_staff_no" id="admission_staff_no"  class="form-control">
                                        <span class="help-block">Supervisor will login using this staff number</span>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email"  class="form-control">
                                        <span class="help-block">Should be a valid email</span>
                                    </div>
                                </div>
                                <!--/span-->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control input-mask"  data-mask="+254700000000" value="+2547">
                                        <span class="help-block">Should be a unique number</span>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class=" selectpicker form-control " name="gender" id="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Faculty </label> &nbsp;<span class="fa fa-plus-square" style="font-size: 18px !important;" id="add_faculty"><i class="zmdi zmdi-plus-square"></i></span>
                                        <select class="form-control" name="faculty" id="faculty_value" required>
                                            <option value="" selected>---------------------------</option>
                                            <?php $__currentLoopData = $faculties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faculty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($faculty->id); ?>"><?php echo e($faculty->faculty); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                    </div>
                                </div>
                                <!--/span-->


                                <!--/span-->
                            </div>
                            <!--/row-->

                        </div>
                        <div class="form-actions">
                            <button type="submit" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> <?php echo app('translator')->getFromJson('app.save'); ?></button>
                            <button type="reset" class="btn btn-default"><?php echo app('translator')->getFromJson('app.reset'); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- .row -->

    <div class="modal fade" id="addFaculty" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">New Faculty</h3>
                </div>
                <div class="modal-body">

                    <!-- content goes here -->
                    <form action="<?php echo e(route('admin.addfaculty')); ?>" method="POST" id="new_faculty_form">

                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label for="title">Faculty</label>
                            <input type="text" class="form-control" name="faculty" id="faculty">
                        </div>
                        <div class="modal-footer">

                            <button type="submit"   class="btn btn-primary btn-hover-green btn-sm pull-left" data-action="save" role="button" id="saveprogram">Add</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script>
        $('#save-form').click(function () {
            $.easyAjax({
                url: '<?php echo e(route('admin.supervisors.store')); ?>',
                container: '#createEmployee',
                type: "POST",
                redirect: true,
                data: $('#createEmployee').serialize()
            })
        });
        $('#add_faculty').on('click', function () {
            $('#faculty').val('');
            $('#addFaculty').modal('show');
        });
        $('#new_faculty_form').on('submit', function (e) {
            e.preventDefault();
            var faculty=$('#faculty').val();
//
            var urls=$(this).attr('action');
            var data=$(this).serialize();
            $.ajax({
                url:urls,
                type:'POST',
                data:data,
                success: function(data){
                    console.log(data.faculty)
                    $('#faculty_value').append($("<option/>", {
                        value : data.id,
                        text : data.faculty,
                    }));

                    $('#addFaculty').modal('hide');
                },
                error:function(xhr){
                    console.log("xhr=" + xhr);
                }
            });


        });
        $('#add_course').on('click', function (e) {
            e.preventDefault();
            var faculties=$(' #faculty_value option');
            var faculty=$('#add_course_form').find('#faculty_id');
            $('#add_course_form #faculty_id').empty();
            $.each(faculties, function (id,pro) {
                $(faculty).append($("<option/>", {
                    value: $(pro).val(),
                    text: $(pro).text(),
                }))
            })
            $('#course').val('');
            $('#add_course_form #course').val('');
            $('#addCourse').modal('show');
        });
        $('#add_course_form').on('submit', function (e) {
            e.preventDefault();
            var data=$(this).serialize();
            $.post("<?php echo e(route('admin.addCourse')); ?>", data, function (data) {
                // console.log(data);
                $('#course').append($("<option/>", {
                    value :data.id,
                    text : data.course,
                }));
                $('#addCourse').modal('hide');
            })
        });
        $('#faculty_value').on('change', function (e) {

            e.preventDefault();
            var course=$('#course');
            $(course).empty();

            var faculty_id=$(this).val();
            $.get("<?php echo e(route('admin.getCourses')); ?>", {faculty_id:faculty_id}, function (data) {
                console.log(data);
                $.each(data, function(i,l){
                    $(course).append($("<option/>", {
                        value :l.id,
                        text : l.course,
                    }));
                });
            })
        })


    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>