<!DOCTYPE html>
<html>
<head>
    <title><?php echo e($student->user->name); ?> Project Log</title>

    <link href="<?php echo e(asset('bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo e(asset('public/plugins/dataTables/responsive.bootstrap.min.css')); ?>">
    <style type="text/css">
        hr.style2 {
            border-top: 3px double #8c8b8b !important;
            height: 1px;
        }
    </style>
</head>
<body>

<div style="text-align: center"><img style="text-align: center" width="125" height="125" src="<?php echo e(URL::to('logo.png')); ?>" class="img-thumbnail"></div>
<figcaption><h3 style="text-align: center">WorkMate</h3></figcaption>
<h4 style="text-align: center" >FACULTY OF <?php echo e($student->user->faculty->faculty); ?></h4>
<h4 style="text-align: center">STUDENT'S PROJECT LOG</h4>
<hr class="style2" style="font-size: larger;">
<div>
    <p> <b>Student's Name:</b> <span style="text-decoration: underline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($student->user->name); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <b>Adm. No:</b><span style="text-decoration: underline" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($student->user->admission_staff_no); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> </p>
</div>
<div><b>Project Title :</b><span style="text-decoration: underline"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($student->proposal->title->title); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
<div><p><b>Supervisor's Name :  </b> <span style="text-decoration: underline"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($student->supervisor->user->name); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> </p></div>
<div>
    <p>This form is to be filled by the supervisor on each consultation date and signed by both the supervisor and student. It is
    to be kept by the student and surrendered to the faculty of <?php echo e($student->user->faculty->faculty); ?> Project Coordinator at the
    of the period together wiht the proposal/project report. The student should consult the supervisor at least once a week.
    The comments should include the task undertaken which indicate the project progress.
    </p>
</div>

<p style="text-align: right">
    <?php
    date_default_timezone_set('Africa/Nairobi');
    echo " <b style='text-align:right!important;'> Printed On</b> : " . date("Y/m/d") . "<b> At</b> " . date("h:i:sa");
    ?>
</p>
<table class="table table-bordered table-hover toggle-circle default footable-loaded footable">
    <thead>
    <tr>
        <th>S/NO</th>
        <th>DATE</th>
        <th>NEXT MILESTONE/DELIVERABLE</th>
        <th>COMMENTS</th>
        <th>APPROVED</th>
        <th>COMPLETION</th>
        <th>SIGN</th>

    </tr>
    </thead>
    <tbody>
         <?php $__currentLoopData = $student->logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(++$key); ?></td>
                    <td><?php echo e(Carbon\Carbon::parse($log->created_at)->format('d/m/Y')); ?></td>
                    <td><?php echo e($log->milestone); ?> <br>
                        <b>Supervisor Additional :</b><br>
                        <?php echo e($log->additional_tasks); ?>

                    </td>
                    <td><?php echo e($log->comments); ?></td>
                    <?php if($log->approved ==1): ?>
                    <td>Approved</td>
                    <?php elseif($log->approved==0): ?>
                    <td>Pending</td>
                    <?php endif; ?>
                    <?php if($log->completion==1): ?>
                        <td>Not Completed</td>
                    <?php elseif($log->completion==2): ?>
                        <td>Partially Completed</td>
                    <?php elseif($log->completion==3): ?>
                        <td>Fully Completed</td>
                    <?php elseif($log->completion==0): ?>
                        <td>Not accessed</td>
                    <?php endif; ?>

                    <td></td>
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