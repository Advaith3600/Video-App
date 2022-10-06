<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">

            @php

            $order_status = trans('order::order.options.status');
            $order_key = array_search($order->status,$order_status);

           

        $order_date = json_decode(json_encode($order->created_at), true);

        $title = "";

        @endphp


        <div class="app-entry-form-section" id="product">
            <div class="section-title">Products</div>
            <div class="row layout-wrap">

                @foreach($order->orderproduct as $key => $value)
                @php


                $title = $value->products->name;
                if(@$value->products->images){
                $title = current($value->products->images)['title'];
                }
                ￼
Email
￼
Company Name

                @endphp
                <div class="col-12 list-item list-item-thumb list-prodcut">
                    <div class="card d-flex flex-row mb-3 border">
                        <a class="d-flex card-img" href="#">
                            <img src="{{ @trans_url($value->products->defaultImage('images' , 'original'))}}"
                                alt="{{$title}}" class="list-thumbnail responsive border-0">
                        </a>


                        <div class="d-flex flex-grow-1 min-width-zero card-content">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <a class="list-item-heading mb-1 truncate w-30 w-xs-100"
                                    href="#">{{$value->products->name}}</a>
                                <input type="hidden" class="form-control online_price" id=""
                                    value="{{$value->products->online_price}}" disabled="">
                               
                                <p class="total_price mb-1 text-muted text-small date w-5 w-xs-100">
                                    {{ number_format($value->quantity,2)}} </p>
                               
                                <p class="total_price mb-1 text-muted text-small date w-5 w-xs-100">
                                   $ {{ number_format($value->quantity * $value->products->online_price,2)}} </p>
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>






        <div class="app-entry-form-section" id="order">
            <div class="section-title">Order Details</div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Order Quantity</th>
                                    <th>Received</th>
                                    <th>Pending</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderproduct as $key => $value) 
                                    <tr>
                                        <td>{!! @$value->products->name !!}|{!! @$value->products->category->name !!}|{!! @$value->products->product_code !!}
                                        @if($value->quantity==$value->received)
                                        <span style="color:green;"><i class="fa fa-check" aria-hidden="true"></i></span>
                                        @endif
                                        </td>
                                        <td>{{$value->quantity}}</td>
                                        <td>{{$value->received}}</td>
                                        <td>{{$value->pending==null?'0':$value->pending}}</td>
                                        <td>{{$value->notes}}</td>
                                        <input type="hidden" id="order_id_{{$value->id}}" name="order_id[]" value="{{$value->id}}">
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title">Full Name</label>
                        <input type="text" class="form-control" value="{{$order->f_name}} {{$order->l_name}}"
                            disabled="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title">Email</label>
                        <input type="text" class="form-control" disabled="" value="{{$order->user->email}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title">Company Name</label>
                        <input type="text" class="form-control" disabled="" value="{{$order->user->company_name}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title">Phone</label>
                        <input type="text" class="form-control" disabled="" value="{{$order->user->phone}}">
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-12 list-item list-item-thumb">
                    <div class="card d-flex flex-row mb-3 border ">
                        <div class="col-md-6 mt-20">

                            <h6>Delivery Address</h6>
                            <p><span> {{$order->f_name}} {{$order->l_name}}</span></p>
                            <p>
                                <label> {{$order->sreet_address}} </label>
                                <label>{{$order->state}} {{$order->zip_code}} </label>
                                <label> {{$order->country}} </label>
                            </p>
                        </div>

                        <div class="col-md-6 mt-20">
                            <h6>Billing Address</h6>
                            <p><span> {{$order->bill_address_to}}</span></p>
                            <p>
                                <label> {{$order->bill_sreet_address}} </label>
                                <label>{{$order->bill_state}} {{$order->bill_zip_code}} </label>
                                <label> {{$order->bill_country}} </label>
                            </p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="app-entry-form-section" id="payment">
            <div class="section-title">Payment Details</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title">Mode of Payment : {{$order->payment_mode}}</label>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title">Delayed :
                            @if($order->payment_mode =="Direct Debit Payment Terms"||$order->payment_mode =="Card Payment Terms")
                            <span class="badge badge-status bg-info">{{@$order->seller->payment_terms_delay}}
                            </span>
                            @else
                            <span class="badge badge-status" {{($order->payment_status !="") ? "style='background-color:#fe5656" :"" }}>{{$order->payment_status}}
                            </span>
                            @endif
                            
                        </label>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title">Payment Status :
                            @if($order->payment_status =="Paid")
                            <span class="badge badge-status bg-info">{{$order->payment_status}}
                            </span>
                            @else
                            <span class="badge badge-status" {{($order->payment_status !="") ? "style='background-color:#fe5656" :"" }}>{{$order->payment_status}}
                            </span>
                            @endif
                            
                        </label>

                    </div>
                </div>
                
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title">Amount :<span class="text-success"> $ {{ $order->amount }} </span></label>

                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title">Shipping Cost :<span class="text-success"> $ {{ $order->shipping_charge }} </span></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title">Total :<span class="text-success"> $ {{ $order->amount + $order->shipping_charge }} </span></label>

                    </div>
                </div>
                @if($order->refund_status !="")
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title">Refund Status : {{$order->refund_status}}</label>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title">Refunded Amount :<span class="text-danger"> $ {{$order->refund_amount}}</span></label>

                    </div>
                </div>
                @endif

            </div>
        </div>



    </div>
    <div class="col-md-3 d-none d-md-block">
        <aside class="app-create-steps">
            <h5 class="steps-header">Steps</h5>
            <div class="steps-wrap" id="steps_nav">
                <a class="step-item active" href="#status"><span>1</span> Delivery Status</a>
                <a class="step-item" href="#product"><span>2</span> Products</a>
                <a class="step-item " href="#order"><span>3</span> Order Details</a>
                <a class="step-item " href="#payment"><span>4</span> Payment Details</a>

            </div>
        </aside>
    </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    let delete_item = "{{ guard_url('order/delete_item')}}/";
    let order_key = "{{$order_key}}";
    $('#refund_status').val('');
    $(".listing-stage").on('click', function() {

        let elm = $(this);
        let prev_status = elm.closest('.listing-stages').find('.active').find('.status').val();
        let prev_key = elm.closest('.listing-stages').find('.active').find('.key').val();
        let elm_key = elm.find('.key').val();
        let status = elm.find('.status').val();

        if (prev_status != "Pending" && order_key <= elm_key) {
            $(".listing-stage").removeClass('active');
            $(".listing-stage").removeClass('empty');

            $(".listing-stage").each(function(index) {
                if (index == elm_key) {
                    $(this).addClass('active');
                    $('#order_status').val(status);
                }
                if (elm_key < index) {
                    $(this).addClass('empty');
                }
            });


            return new Promise((resolve) => {
                swal({
                    title: "Are you sure?",
                text: "You will not be able to recover this data!",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: "Ok"
                },
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#update_button').click();
                    }
                });
            });

        }
    });
    //
    $(".quantity").bind('keyup mouseup', function() {
        elm = $(this);
        let quantity = elm.val();
        let online_price = elm.closest('.card-content').find('.online_price').val();
        if (quantity != 0 && quantity != "") {
            let total = online_price * quantity;
            elm.closest('.card-content').find('.total_price').text(total.toFixed(2));
        }
    });
    $(".remove_item").on('click', function(e) {
        elm = $(this);
        let id = elm.attr('data-id');

        return new Promise((resolve) => {
            swal({
                    title: "Are you sure?",
                text: "You will not be able to recover this data!",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: "Ok"
                },
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: delete_item + id,
                        type: "POST",
                        success: function() {
                            elm.closest('.list-prodcut').remove();

                        },
                        error: function() {
                            swal({
                                title: 'Opps...',
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    })
                }
            });
        });

    });
});
</script>
