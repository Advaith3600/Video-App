<div class="app-entry-form-wrap">
                            <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
                                <i class="las la-box app-sec-title-icon"></i>
                                <h2>Order #{{$order->order_code}}</h2>
                                <!-- <div class="actions">
                                    <button type="button" class="btn btn-with-icon btn-link text-success"><i class="las la-check-circle"></i><span>Confirm Order</span></button>
                                    <button type="button" class="btn btn-with-icon btn-link"><i class="las la-trash"></i><span>Delete</span></button>
                                    <button type="button" class="btn btn-with-icon btn-link"><i class="lab la-wpforms"></i><span>Invoice</span></button>
                                    <button type="button" class="btn btn-with-icon btn-link"><i class="las la-times"></i></button>
                                </div> -->
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-9">
                                        <form class="app-entry-form pl-0 pr-0" action="">
                                        @php

                                        $order_date = json_decode(json_encode($order->created_at), true);

                                            $image ='img/default/original.jpg';

                                         @endphp
                                         {!!Form::vertical_open()
                                        ->method('PUT')
                                        ->id('form-edit')
                                        ->action(guard_url('order/order/'. $order->getRouteKey()))!!}
                                        <div class="app-entry-form-section" id="images">
                                                <div class="section-title">Products</div>
                                                <div class="row layout-wrap">

                                                @foreach($order->orderproduct as $key => $value)
                                                @php
                                                    $title = $value->products->name;
                                                    if(@$value->products->images){
                                                        $image = 'image/xs/'.current($value->products->images)['path'];
                                                        $title = current($value->products->images)['title'];
                                                    }

                                                @endphp
                                                <div class="col-12 list-item list-item-thumb">
                                                        <div class="card d-flex flex-row mb-3 border">
                                                            <a class="d-flex card-img" href="#">
                                                                <img src="{{trans_url($image)}}" alt="{{$title}}" class="list-thumbnail responsive border-0">
                                                            </a>
                                                            <div class="d-flex flex-grow-1 min-width-zero card-content">
                                                                <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                                                    <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="#">{{$value->products->name}}</a>
                                                                    <p class="mb-1 text-muted text-small category w-15 w-xs-100">{{$order->status}}</p>
                                                                    <p class="mb-1 text-muted text-small date w-15 w-xs-100">{{$value->price}} </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                            @endforeach




                                                </div>
                                            </div>
                                        {!!Form::close()!!}





                                            @php
                                            $order_status = array('Pending','Processing','Dispatched','Shipped','On The Way','Out for Delivery','Delivered');
                                             $order_key = array_search($order->status,$order_status);

                                             @endphp
                                            <div class="app-entry-form-section" id="images">
                                                <div class="section-title">Status</div>
                                                <div class="pipeline-wrap pb-50">
                                                    <div class="pipeline-spreads">
                                                        <div class="listing-stages">
                                                        @foreach($order_status as $key => $value)

                                                        @php
                                                        $class ="";
                                                        if($order_key == $key){
                                                            $class ="active";
                                                        }
                                                        if($order_key < $key){
                                                            $class ="empty";
                                                        }

                                                        @endphp


                                                            <div class="listing-stage {{$class}}">
                                                                <div class="listing-stage-label-container">
                                                                    <div class="listing-stage-label">
                                                                        <div><span>Move to: </span>{{$value}}</div>
                                                                    </div>
                                                                </div>
                                                                <div class="horizontal-line col-12">
                                                                    <div class="horizontal-line-pre-line"></div>
                                                                    <div class="horizontal-line-content">
                                                                        <div class="listing-stage-checkbox">
                                                                            <span class="icon fa fa-check"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="horizontal-line-post-line"></div>
                                                                </div>
                                                            </div>
                                                        @endforeach




                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="app-entry-form-section" id="basic">
                                                <div class="section-title">Receipt Goods</div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="task_title">Order ID</label>
                                                            <input type="text" class="form-control" value="#{{$order->order_code}}" disabled="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="task_title">Full Name</label>
                                                            <input type="text" class="form-control" value="{{$order->f_name}} {{$order->l_name}}" disabled="" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="task_title">Email</label>
                                                            <input type="text" class="form-control"  disabled="" value="{{$order->user->email}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="task_title">Telephone</label>
                                                            <input type="text" class="form-control" value="{{$order->user->mobile}}"  disabled="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="col-md-3 d-none d-md-block">
                                        <aside class="app-create-steps">
                                            <h5 class="steps-header">Steps</h5>
                                            <div class="steps-wrap" id="steps_nav">
                                                <a class="step-item" href="#products"><span>1</span> Products</a>
                                                <a class="step-item" href="#status"><span>2</span> Status</a>
                                                <a class="step-item active" href="#basic"><span>3</span> Receipt Goods</a>

                                            </div>
                                        </aside>
                                    </div>
                                </div>
                            </div>


                        </div>
<script>
$(".horizontal-line").on('click',function(){
        //    alert('sss');
        // $('#form-edit').submit();
});
</script>
