
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
                <li><a href="<?php echo e(route('supervisor.dashboard')); ?>">Home</a></li>
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
    <link rel="stylesheet" href="<?php echo e(URL::to('css/app_1.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('css/app_2.min.css')); ?>">
    <link href="<?php echo e(URL::to('plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    
    <link href="<?php echo e(asset('plugins/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')); ?>" rel="stylesheet">
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
        .lgi-attrs li.lgi-completion{
            border-color: #03A9F4!important;
            color:#03A9F4 !important;
        }
        .action-header{padding:25px 30px;line-height:100%;position:relative;z-index:1;min-height:65px;background-color:#F7F7F7}
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="card">
                    <?php if(Session::has('message')): ?>
                        <p class="alert alert-danger"><?php echo e(Session::get('message')); ?></p>
                    <?php endif; ?>
                    <div class="card-header">
                        <h2>Documentations Chapters
                            <small>Approve and review student documentation chapters and final documentation </small>
                        </h2>
                    </div>

                    <div class="card-body card-padding">
                        <div class="list-group lg-odd-black">
                            <div class="action-header clearfix">
                                <div class="ah-label hidden-xs">Documentation Chapters for <?php echo e($doc->student->user->name); ?></div>
                                <ul class="actions">
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown" aria-expanded="true">
                                            <i class="zmdi zmdi-sort"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <?php echo $__env->make('supervisor.documentations.chapters.chapterone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php echo $__env->make('supervisor.documentations.chapters.chaptertwo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php echo $__env->make('supervisor.documentations.chapters.chapterthree', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php echo $__env->make('supervisor.documentations.chapters.final', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <?php if(!empty($warning)): ?>
                            <p class="alert alert-danger"><?php echo e($warning); ?></p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('supervisor.documentations.modals.assessChapterOneModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('supervisor.documentations.modals.editChapterOneModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('supervisor.documentations.modals.assessChapterTwoModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('supervisor.documentations.modals.editChapterTwoModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('supervisor.documentations.modals.assessChapterThreeModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('supervisor.documentations.modals.editChapterThreeModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('supervisor.documentations.modals.assessFinalModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('supervisor.documentations.modals.editFinalModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
        function assessChapterOne(id) {
            $("input[name='chapter_one_id']").val(id);
            $('#assessChapterOne').modal('show');

        }
        function editChapterOneAssessment(id) {
            var submiturl = "<?php echo e(URL::to('supervisor/project/doc/chapterOne/assessment/edit')); ?>";
            $.ajax({
                url: submiturl + '/' + id,
                type: 'GET',
                data: '',
                success: function (data) {
                    console.log(data)
                    $("input[name='chapter_one_id']").val(data.id);
                    $("textarea[name='comment']").val(data.comment);
                },
                error: function (xhr) {
                    console.log("xhr=" + xhr);
                }
            });
            $('#editChapterOneAssessment').modal('show')
        }
        function chapterOneDelete(id) {
            swal({
                title: "Are you sure?",
                text: "You are about to delete this Assessment!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                closeOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    document.getElementById(id).submit();
                }
            });

        }

        function assessChapterTwo(id) {
            $("input[name='chapter_two_id']").val(id);
            $('#assessChapterTwo').modal('show');

        }
        function editChapterTwoAssessment(id) {
            var submiturl = "<?php echo e(URL::to('supervisor/project/doc/chapterTwo/assessment/edit')); ?>";
            $.ajax({
                url: submiturl + '/' + id,
                type: 'GET',
                data: '',
                success: function (data) {
                    console.log(data)
                    $("input[name='chapter_two_id']").val(data.id);
                    $("textarea[name='comment']").val(data.comment);
                },
                error: function (xhr) {
                    console.log("xhr=" + xhr);
                }
            });
            $('#editChapterTwoAssessment').modal('show')
        }
        function chapterTwoDelete(id) {
            swal({
                title: "Are you sure?",
                text: "You are about to delete this Assessment!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                closeOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    document.getElementById(id).submit();
                }
            });

        }

        function assessChapterThree(id) {
            $("input[name='chapter_three_id']").val(id);
            $('#assessChapterThree').modal('show');

        }
        function editChapterThreeAssessment(id) {
            var submiturl = "<?php echo e(URL::to('supervisor/project/doc/chapterThree/assessment/edit')); ?>";
            $.ajax({
                url: submiturl + '/' + id,
                type: 'GET',
                data: '',
                success: function (data) {
                    console.log(data)
                    $("input[name='chapter_three_id']").val(data.id);
                    $("textarea[name='comment']").val(data.comment);
                },
                error: function (xhr) {
                    console.log("xhr=" + xhr);
                }
            });
            $('#editChapterThreeAssessment').modal('show')
        }
        function chapterThreeDelete(id) {
            swal({
                title: "Are you sure?",
                text: "You are about to delete this Assessment!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                closeOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    document.getElementById(id).submit();
                }
            });

        }

        function assessFinal(id) {
            $("input[name='documentation_id']").val(id);
            $('#assessFinal').modal('show');

        }
        function editFinalAssessment(id) {
            var submiturl = "<?php echo e(URL::to('supervisor/project/doc/final/assessment/edit')); ?>";
            $.ajax({
                url: submiturl + '/' + id,
                type: 'GET',
                data: '',
                success: function (data) {
                    console.log(data)
                    $("input[name='documentation_id']").val(data.id);
                    $("textarea[name='comment']").val(data.comment);
                },
                error: function (xhr) {
                    console.log("xhr=" + xhr);
                }
            });
            $('#editFinalAssessment').modal('show')
        }
        function finalDelete(id) {
            swal({
                title: "Are you sure?",
                text: "You are about to delete this Assessment!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                closeOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    document.getElementById(id).submit();
                }
            });

        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.member-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>