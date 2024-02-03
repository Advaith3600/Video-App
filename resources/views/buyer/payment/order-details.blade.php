<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="content-area">
            <main id="main" class="site-main">
                <div class="row">
                    <div class="col-md-3">
                        <div class="user-profile-card">
                            <div class="user-img" style="background-image: url('img/user/male.png')"></div>
                            <div class="user-info">
                                <h5>Hello,</h5>
                                <h2 class="text-capitalize">{{ user()->name }}</h2>
                            </div>
                        </div>
                        {!! Theme::partial('aside') !!}
                        {{-- <div class="user-aside-nav">
                            <div class="list-group">
                                <a href="user-profile.html" class="list-group-item list-group-item-action"><i class="las la-user-circle"></i>My Account</a>
                                <a href="user-orders.html" class="list-group-item list-group-item-action"><i class="las la-cubes"></i>Order History</a>
                                <a href="user-address.html" class="list-group-item list-group-item-action"><i class="las la-map-marker"></i>Addresses</a>
                                <a href="user-wishlist.html" class="list-group-item list-group-item-action"><i class="lar la-heart"></i>Wishlists</a>
                                <a href="user-track-order.html" class="list-group-item list-group-item-action active"><i class="las la-search-location"></i>Track Order</a>
                                <a href="login.html" class="list-group-item list-group-item-action"><i class="las la-sign-out-alt"></i>Log Out</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-md-9">
                        <div class="user-content-wrap">
                            <div class="user-content-title">
                                <h3>Track Order</h3>
                            </div>
                            <div class="user-content">
                                <div class="track-detail-wrapper">
                                    @forelse($orders as $order)
                                    <div class="track-header d-flex justify-content-between">
                                        <h3>Order ID - {{ @$order->order_id }}</h3>
                                        <h3>Order Date {{ @$order->ordered_date }}</h3>
                                    </div>
                                    <div class="track-order-address">
                                        <h3>Address</h3>
                                        <p><span>{{ @$order->client_name }}
                                            </span>{{ @$order->address_line1 }},{{ @$order->address_line2 }},{{ @$order->district }},{{ @$order->state }},{{ @$order->postal_code }}-
                                            {{ @$order->phone }}</p>
                                    </div>
                                    @break
                                    @empty
                                    @endif
                                    @forelse($orders as $order)

                                    <div class="track-item-details d-flex justify-content-between align-items-center">
                                        {{-- {{ dd($order) }} --}}
                                        <div class="item-details">
                                            <h4><a href="#">{{ @$order->product_name }} </a></h4>
                                            <p>{{ @$order->highlights}}</p>
                                            <div class="price">₹ {{ @$order->price}}</div>
                                        </div>
                                        <div class="item-img">
                                            {{-- <img src="http://webnapps.in/e-buy/design/img/products/mini-cart1.jpg" class="img-fluid" alt=""> --}}

                                            @if($order->images)
                                            @foreach (json_decode($order->images, true) as $image)
                                            <img width="180" height="180"
                                                src="{{ url('image/original' . '/' . $image['path']) }}"
                                                class="img-fluid" alt="">

                                            @break
                                            @endforeach
                                            @endif
                                            <p>Quantity: {{ @$order->product_quantity}}</p>
                                        </div>

                                    </div>
                                    <div id="status_div">
                                        <div class="track-timelime" >
                                            @if($order->status=='Ordered'|| $order->status=='Processing'||
                                            $order->status=='Packed'||$order->status=='Shipped'||$order->status=='Delivered')
                                            <div class="timeline-item active">
                                                <h4>Ordered and Approved</h4>
                                                <p>Your Order has been placed.</p>
                                            </div>
                                            @endif
                                            @if($order->status=='Processing'||$order->status=='Packed'||$order->status=='Shipped'||$order->status=='Delivered')
                                            <div class="timeline-item">
                                                <h4>Processing</h4>
                                                <p>Your item has been picked up by courier partner.</p>
                                            </div>
                                            @endif
                                            @if($order->status=='Packed'||$order->status=='Shipped'||$order->status=='Delivered')
                                            <div class="timeline-item">
                                                <h4>Packed</h4>
                                                <p>Your item has been picked up by courier partner.</p>
                                            </div>
                                            @endif
                                            @if($order->status=='Shipped'||$order->status=='Delivered')
                                            <div class="timeline-item">
                                                <h4>Shipped</h4>
                                                <p>Item has been shipped</p>
                                            </div>
                                            @endif
                                            @if($order->status=='Delivered')
                                            <div class="timeline-item">
                                                <h4>Delivered</h4>
                                                <p>Your item has been delivered</p>
                                            </div>
                                            @endif
                                            @if($order->status=='Cancelled')
                                            <div class="timeline-item">
                                                <h4>Cancelled</h4>
                                                <p>Your item has been cancelled</p>
                                            </div>
                                            @endif
                                            @if($order->status=='Returned')
                                            <div class="timeline-item">
                                                <h4>Return requested</h4>
                                            </div>
                                            @endif
                                        </div>
                                  
                                        @if($order->status=='Delivered')
                                        <button class="btn btn-danger btn-return" data-toggle="modal" data-target="#returned">Return</button>
                                        @elseif($order->status=='Ordered'|| $order->status=='Processing')
                                       
                                        <button class="btn btn-danger"  data-toggle="modal" data-target="#cancellation">Cancel</button>
                                      
                                        @endif
                                    </div>
                                        <div class="modal modal-theme fade" id="cancellation" tabindex="-1" role="dialog"
                                            aria-labelledby="cancellationTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" class="m-0">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Cancellation Request</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span class="las la-times" aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="name">Reason<sup>*</sup></label><input
                                                                            class="form-control"
                                                                            placeholder="Please enter the reason"  id="reason"
                                                                            type="text" name="reason" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="phone">Comments</label><input
                                                                            class="form-control"
                                                                            placeholder="Please enter comments"id="phone" type="textarea"
                                                                            name="comments">
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="order_id" id="order_id"value="{{@$order->order_id}}">
                                                                <input type="hidden" name="status" id="status" value="Cancelled">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-secondary submit-cancel" 
                                                                >Confirm Cancellation</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal modal-theme fade" id="returned" tabindex="-1" role="dialog"
                                            aria-labelledby="returnedTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" class="m-0">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Request Return</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span class="las la-times" aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="name">Reason<sup>*</sup></label><input
                                                                            class="form-control"
                                                                            placeholder="Please enter the reason"  id="return_reason"
                                                                            type="text" name="reason" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="phone">Comments</label><input
                                                                            class="form-control"
                                                                            placeholder="Please enter comments"id="return_comments" type="textarea"
                                                                            name="comments">
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="order_id" id="order_id"value="{{@$order->order_id}}">
                                                                <input type="hidden" name="status" id="return_status" value="Returned">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-secondary submit-return" 
                                                                >Return</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    @empty
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".submit-cancel").click(function(event) { 
        event.preventDefault();
            var reason = $("#reason").val();
            var comments = $("#comments").val();
            var id = $("#order_id").val();
            var status = $("#status").val();
            $.ajax({
                type: "POST",
                url: '{{trans_url('order/cancel_order')}}',
                data: { reason: reason, comments: comments,id: id,status: status }, 
                success: function(data) {
                    $('#cancellation').modal('toggle');
                    $("#status_div").load('{{guard_url('order/order_status')}}'+'/'+id);
                    toastr.success( "Order has been cancelled successfully", "Success");

                }
            })
    });
    $(".submit-return").click(function(event) { 
        event.preventDefault();
            var reason = $("#return_reason").val();
            var comments = $("#return_comments").val();
            var id = $("#order_id").val();
            var status = $("#return_status").val();
            $.ajax({
                type: "POST",
                url: '{{trans_url('order/cancel_order')}}',
                data: { reason: reason, comments: comments,id: id,status: status }, 
                success: function(data) {
                    $('#returned').modal('toggle');
                    $("#status_div").load('{{guard_url('order/order_status')}}'+'/'+id);
                    toastr.success( "Return request successfully", "Success");

                }
            })
    });
      
});
</script>