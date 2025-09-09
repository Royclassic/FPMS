<div class="media">
    <div class="media-body">
        <h5 class="media-heading"><span class="btn btn-circle btn-inverse"><i class="icon-doc"></i></span> New Estimate received</h5>
        Estimate of {{ $notification->data['currency'].' '.$notification->data['total'] }} is received.
    </div>
    <h6><i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->data['created_at'])->diffForHumans() }}</i></h6>
</div>