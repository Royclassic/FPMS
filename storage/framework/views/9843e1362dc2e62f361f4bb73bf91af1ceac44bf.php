<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title"><i class="icon-note"></i> <?php echo app('translator')->getFromJson("modules.messages.startConversation"); ?></h4>
</div>
<div class="modal-body">
    <div class="portlet-body">

        <?php echo Form::open(['id'=>'createChat','class'=>'ajax-form','method'=>'POST']); ?>

        <div class="form-body">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label><?php echo app('translator')->getFromJson("modules.messages.chooseMember"); ?></label>
                        <select class="select2 form-control" data-placeholder="<?php echo app('translator')->getFromJson("modules.messages.chooseMember"); ?>" name="user_id" id="user_id">
                            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                        value="<?php echo e($member->id); ?>"><?php echo e(ucwords($member->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for=""><?php echo app('translator')->getFromJson("modules.messages.message"); ?></label>
                        <textarea name="message" class="form-control" id="message" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions m-t-20">
            <button type="button" id="post-message" class="btn btn-success"><i class="fa fa-send-o"></i> <?php echo app('translator')->getFromJson("modules.messages.send"); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>


<script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>

<script>

    $('.select2').select2();

    $('#post-message').click(function () {
        $.easyAjax({
            url: '<?php echo e(route('supervisor.user-chat.message-submit')); ?>',
            container: '#createChat',
            type: "POST",
            data: $('#createChat').serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    var blank = "";
                    $('#submitTexts').val('');

                    //getting values by input fields
                    var dpID = $('#dpID').val();
                    var dpName = $('#dpName').val();


                    //set chat data
                    getChatData(dpID, dpName);

                    //set user list
                    $('.userList').html(response.userList);

                    //set active user
                    if (dpID) {
                        $('#dp_' + dpID + 'a').addClass('active');
                    }

                    $('#newChatModal').modal('hide');
                }
            }
        })
    });
</script>