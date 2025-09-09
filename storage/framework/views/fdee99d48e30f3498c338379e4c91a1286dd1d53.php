<!DOCTYPE html>
<html>
<head>
    <title>Students Reports</title>

    <link href="<?php echo e(asset('bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo e(asset('public/plugins/dataTables/responsive.bootstrap.min.css')); ?>">

</head>
<style type="text/css">
    hr.style2 {
        border-top: 3px double #8c8b8b !important;
        height: 1px;
    }
</style>
<body>

<div style="text-align: center"><img style="text-align: center" width="125" height="125" src="<?php echo e(URL::to('logo.png')); ?>" class="img-thumbnail"></div>
<figcaption><h3 style="text-align: center">WorkMate</h3></figcaption>
<hr class="style2" style="font-size: larger;">
<h2 style="text-align: center">System Students</h2>
<p style="text-align: right">
    <?php
    date_default_timezone_set('Africa/Nairobi');
    echo " <b style='text-align:right!important;'> Printed On</b> : " . date("Y/m/d") . "<b> At</b> " . date("h:i:sa");
    ?>
</p>
<table class="table table-bordered table-hover toggle-circle default footable-loaded footable">
    <thead>
    <tr>
        <th># </th>
        <th>Name</th>
        <th>Student Number</th>
        <th>Faculty</th>
        <th>Course</th>
        <th>Email</th>
        <th width="80">Created on</th>

    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$key); ?></td>
                <td><?php echo e($student->name); ?></td>
                <td><?php echo e($student->admission_staff_no); ?></td>
                <td><?php echo e($student->faculty); ?>

                <td><?php echo e($student->course); ?></td>
                <td><?php echo e($student->email); ?></td>
                <td><?php echo e(Carbon\Carbon::parse($student->created_at)->format('d-m-Y')); ?></td>

            </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>


</table>
<!-- jQuery -->
<script src="<?php echo e(asset('plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo e(asset('bootstrap/dist/js/bootstrap.min.js')); ?>"></script>

</body>
</html>