<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="content-area">
            <main id="main" class="site-main">
                <div class="success-wrap">
                    <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                        <span class="swal2-success-line-tip"></span>
                        <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                    </div>
                    <div class="text-center mb-30">
                        <h2>Thanks, For shopping with us, {{@$order->address->name}}!</h2>
                        <p>We'll follow up with another email once your items have shipped</p>
                        <div class="order-id mb-10">
                            <span>Your Order ID:{{@$order->id}}</span>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{{guard_url('order/order')}}" class="btn btn-primary">Track Your Order</a>
                        </div>
                    </div>
                    <hr>
                    <div class="order-details-wrap mt-30 mb-30">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="order-metas">
                                    <p class="meta-item">Order Number: <span>EB6576T4</span></p>
                                    <p class="meta-item">Order Date: <span>{{@$order->created_at->format('d D Y,H:i A')}}</span></p>
                                    <p class="meta-item">Order Status: <span class="badge badge-success">{{@$order->status}}</span></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="address-wrap">
                                    <p>Your product will sent to:</p>
                                    <h3 class="m-0">{{@$order->address->name}}</h3>
                                    <p class="m-0">{{@$order->address->address_line1}}, {{@$order->address->address_line2}}, {{@$order->address->postal_code}}, {{@$order->address->district}} ,{{@$order->address->state}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="shopping-cart wishlist">
                        <div class="cart-single-item">
                            <div class="row align-items-center">
                                @foreach($products as $key=>$product) 
                                <div class="col-lg-8 col-md-7">
                                    <div class="product-item d-flex align-items-center">
                                        <div class="product-img">
                                            <img src="img/products/mini-cart1.jpg" class="img-fluid" alt="">
                                        </div>
                                        <div class="content">
                                            <h6><a href="#">{{@$product->name}} </a> <span>ID: {{@$product->product_id}}</span></h6>
                                            <!--<p>Type : {{@$product->category->name}}</p>-->
                                            <p>Quantity : {{@$product->quantity}}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-lg-4 col-md-5 text-right">
                                    <h3 class="total m-0">₹ {{@$order->total}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<style>
    .swal2-icon.swal2-success {
        border-color: rgb(165, 220, 134);
    }
    [class^="swal2"] {
        -webkit-tap-highlight-color: transparent;
    }
    .swal2-icon {
        position: relative;
        justify-content: center;
        width: 5em;
        height: 5em;
        line-height: 5em;
        cursor: default;
        box-sizing: content-box;
        user-select: none;
        zoom: normal;
        margin: 1.25em auto 1.875em;
        border-width: 0.25em;
        border-style: solid;
        border-image: initial;
        border-radius: 50%;

    }
</style>