<?php $__empty_1 = true; $__currentLoopData = $userLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

    <li id="dp_<?php echo e($userList->id); ?>">
        <a href="javascript:void(0)" id="dpa_<?php echo e($userList->id); ?>"
           class="<?php if(isset($userID) && $userID == $userList->id): ?> active <?php endif; ?>"
           onclick="getChatData('<?php echo e($userList->id); ?>', '<?php echo e($userList->name); ?>')">

            <img src="<?php if(is_null($userList->image)): ?> <?php echo e(asset('default-profile-2.png')); ?> <?php else: ?> <?php echo e(asset('profile/'.$userList->image)); ?> <?php endif; ?>"
                 alt="user-img" class="img-circle">
                                            <span <?php if($userList->message_seen == 'no' && $userList->user_one != $user->id): ?> class="font-bold" <?php endif; ?>><?php echo e($userList->name); ?>

                                                <small class="text-simple"><?php if($userList->last_message): ?><?php echo e(\Carbon\Carbon::parse($userList->last_message)->diffForHumans()); ?> <?php endif; ?></small>
                                            </span>
        </a>
    </li>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <li>
        <a href="javascript:void(0)">
            <span>
                <?php echo app('translator')->getFromJson('messages.noConversation'); ?>
            </span>
        </a>
    </li>
<?php endif; ?>