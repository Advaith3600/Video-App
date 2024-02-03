<div class="track-timelime">
    @if(@$order->status=="Cancelled")
    <div class="timeline-item">
        <h4>Cancelled</h4>
        <p>Your item has been cancelled</p>
    </div>
    @endif
    @if(@$order->status=="Returned")
    <div class="timeline-item">
        <h4>Return Requested</h4>
    </div>
    @endif
</div>
