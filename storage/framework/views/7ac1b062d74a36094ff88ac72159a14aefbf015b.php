<?php $__currentLoopData = $stickyNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div id="stickyBox_<?php echo e($note->id); ?>" class="col-md-12 sticky-note">
        <div class="well
             <?php if($note->colour == 'red'): ?>
                bg-danger
             <?php endif; ?>
        <?php if($note->colour == 'green'): ?>
                bg-success
             <?php endif; ?>
        <?php if($note->colour == 'yellow'): ?>
                bg-warning
             <?php endif; ?>
        <?php if($note->colour == 'blue'): ?>
                bg-info
             <?php endif; ?>
        <?php if($note->colour == 'purple'): ?>
                bg-purple
             <?php endif; ?>
                b-none">
            <p><?php echo nl2br($note->note_text); ?></p>
            <hr>
            <div class="row font-12">
                <div class="col-xs-9">
                    <?php echo app('translator')->getFromJson("modules.sticky.lastUpdated"); ?>: <?php echo e($note->updated_at->diffForHumans()); ?>

                </div>
                <div class="col-xs-3">
                    <a href="javascript:;"  onclick="showEditNoteModal(<?php echo e($note->id); ?>)"><i class="ti-pencil-alt text-white"></i></a>
                    <a href="javascript:;" class="m-l-5" onclick="deleteSticky(<?php echo e($note->id); ?>)" ><i class="ti-close text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>