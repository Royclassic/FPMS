<div class="media">
    <div class="media-body">
        <h5 class="media-heading"><span class="btn btn-circle btn-success"><i class="icon-user"></i></span> Welcome to <?php echo e($companyName); ?> !</h5>
    </div>
    <h6><i><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->data['created_at'])->diffForHumans()); ?></i></h6>
</div>