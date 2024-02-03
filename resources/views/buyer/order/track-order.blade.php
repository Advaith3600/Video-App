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
                                <form action="user-track-order-details.html" method="post" class="m-0">
                                    <div class="form-group">
                                        <label for="order_id">Order ID</label>
                                        <input type="text" class="form-control" placeholder="Enter your order id here" required value="OD110675700">
                                    </div>
                                    <button type="submit" class="btn btn-secondary">Get Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
{!! Theme::partial('footer') !!}
