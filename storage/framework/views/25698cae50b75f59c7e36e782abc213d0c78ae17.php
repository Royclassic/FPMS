<?php $__empty_1 = true; $__currentLoopData = $proposal->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-9">
                <?php echo e($file->filename); ?>

            </div>
            <div class="col-md-3">
                <a target="_blank" href="<?php echo e(asset('storage/codes/'.$proposal->id.'/'.$file->hashname)); ?>"
                   data-toggle="tooltip" data-original-title="View"
                   class="btn btn-info btn-circle"><i class="fa fa-search"></i></a>
                &nbsp;&nbsp;
                <a href="<?php echo e(route('student.files.download', $file->id)); ?>" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
               <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-file-id="<?php echo e($file->id); ?>" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>

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