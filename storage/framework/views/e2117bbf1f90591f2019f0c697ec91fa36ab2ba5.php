<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> Project Codes</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('student.dashboard.index')); ?>"><?php echo app('translator')->getFromJson('app.menu.home'); ?></a></li>
                <li class="active">Codes</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/dropzone-master/dist/dropzone.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">

            <section>
                <div class="sttabs tabs-style-line">
                    <div class="white-box">
                        <nav>
                            <ul>
                                <li class="tab-current"><a href="#"><span><?php echo e($proposal->title->title); ?></span></a> </li>

                            </ul>
                        </nav>
                    </div>
                    <div class="content-wrap">
                        <section id="section-line-3" class="show">
                            <div class="row">
                                <div class="col-md-12" id="files-list-panel">
                                    <div class="white-box">
                                        <h2><?php echo app('translator')->getFromJson('modules.projects.files'); ?></h2>

                                        <ul class="list-group" id="files-list">
                                            <?php $__empty_1 = true; $__currentLoopData = $proposal->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <?php echo e($file->filename); ?>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <a target="_blank" href="<?php echo e(asset('storage/codes/'.$proposal->id.'/'.$file->hashname)); ?>"
                                                               data-toggle="tooltip" data-original-title="View"
                                                               class="btn btn-info btn-circle"><i
                                                                        class="fa fa-search"></i></a>
                                                            &nbsp;&nbsp;
                                                            <a href="<?php echo e(route('supervisor.files.download', $file->id)); ?>"
                                                               data-toggle="tooltip" data-original-title="Download"
                                                               class="btn btn-inverse btn-circle"><i
                                                                        class="fa fa-download"></i></a>
                                                            <span class="m-l-10"><?php echo e($file->created_at->diffForHumans()); ?></span>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <?php echo app('translator')->getFromJson('messages.noFileUploaded'); ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </section>

                    </div><!-- /content -->
                </div><!-- /tabs -->
            </section>
        </div>


    </div>
    <!-- .row -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/dropzone-master/dist/dropzone.js')); ?>"></script>
    <script>
        $('#show-dropzone').click(function () {
            $('#file-dropzone').toggleClass('hide show');
        });

        $("body").tooltip({
            selector: '[data-toggle="tooltip"]'
        });

        // "myAwesomeDropzone" is the camelized version of the HTML element's ID
        Dropzone.options.fileUploadDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 100, // MB,
            dictDefaultMessage: 'Drop files here OR click to upload',
            accept: function (file, done) {
                done();
            },
            init: function () {
                this.on("success", function (file, response) {
                    console.log(response);
                    $('#files-list-panel ul.list-group').html(response.html);
                })
            }
        };

        $('body').on('click', '.sa-params', function () {
            var id = $(this).data('file-id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover the deleted file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {

                    var url = "<?php echo e(route('student.files.destroy',':id')); ?>";
                    url = url.replace(':id', id);

                    var token = "<?php echo e(csrf_token()); ?>";

                    $.easyAjax({
                        type: 'DELETE',
                        url: url,
                        data: {'_token': token},
                        success: function (response) {
                            if (response.status == "success") {
                                $.unblockUI();
//                                    swal("Deleted!", response.message, "success");
                                $('#files-list-panel ul.list-group').html(response.html);

                            }
                        }
                    });
                }
            });
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>