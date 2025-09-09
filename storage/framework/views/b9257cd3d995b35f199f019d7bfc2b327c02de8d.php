<div class="media">
    <div class="media-body">
        <h5 class="media-heading"><span class="btn btn-circle btn-warning"><i class="icon-note"></i></span> New notice - <?php echo e(ucfirst($notification->data['heading'])); ?></h5>
        <?php echo e(ucfirst($notification->data['description'])); ?> </div>
    <h6><i><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->data['created_at'])->diffForHumans()); ?></i></h6>
</div>