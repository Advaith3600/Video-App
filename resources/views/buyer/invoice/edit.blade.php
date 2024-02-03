<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="las la-box app-sec-title-icon"></i>
        <h2>Order #{{@$order->order_code}}</h2>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 d-none d-md-block">
                <form class="app-entry-form pl-0 pr-0" action="">
                    
                    
                    <div class="app-entry-form-section" id="product">
                        <div class="section-title">Products</div>
                        <div class="row layout-wrap">
                            @foreach($order->orderproduct as $key => $value)
                            @php
                            $title = $value->products->name;
                            if(@$value->products->images){
                            $title = current($value->products->images)['title'];
                            }
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
                                            @if($order->status == "Pending")
                                            <div class="form-group w-5 w-xs-100">
                                                <label for=""> Quantity</label>
                                                {!! Form::number("quantity[".$value->products->id."]")
                                                -> label('quantity')
                                                ->addClass("form-control quantity")
                                                ->value($value->quantity)
                                                ->setattribute('min','1')
                                                ->setattribute('max',$value->quantity)
                                                ->raw()!!}
                                            </div>
                                            @else
                                            <p class="total_price mb-1 text-muted text-small date w-5 w-xs-100">
                                                {{ number_format($value->quantity,2)}} </p>
                                            @endif
                                            <p class="total_price mb-1 text-muted text-small date w-5 w-xs-100">
                                                {{ number_format($value->quantity * $value->products->online_price,2)}}
                                            </p>
                                            <!-- <button class="remove btn  w-12 w-xs-100  remove_item" style="color:#fe5656"
                                        data-id="{{$value->id}}" type="button"><i class="las la-trash"></i></button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="app-entry-form-section" id="order">
                        <div class="section-title">Order Details</div>
                        <h7><strong>Supplier : {{@$order->seller->company_name}}</strong></h7>
                        
                       
                        
                        
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

                @if($order->payment_status == "Paid")
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="task_title"><a href="{{guard_url('invoice/download_invoice')}}/{{$order->id}}">Download Invoice</a></label>

                    </div>
                </div>
                @elseif($order->payment_status == "Pending" && $order->payment_mode =="Card Payment Terms" || $order->payment_mode =="Direct Debit Payment Terms")
                <div class="col-md-6">
                    <div class="form-group">
                        <a id="pay_now" class="btn" style="font-weight: 400; font-size: 14px; border-radius: 6px; padding: 5px 20px; display: inline-block; background-color: #ef6c37; color: #fff; text-decoration: none;">Pay Now</a> 
                    </div>
                </div>
                @endif
                
                

            </div>
        </div>
                </form>
            </div>
            <div class="col-md-3 d-none d-md-block">
                <aside class="app-create-steps">
                    <h5 class="steps-header">Steps</h5>
                    <div class="steps-wrap" id="steps_nav">
                        <a class="step-item  active" href="#product"><span>1</span> Products</a>
                        <a class="step-item " href="#order"><span>3</span> Order Details</a>
                        <a class="step-item" href="#payment"><span>2</span> Payment Details</a>


                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<script>
   
    
    $('#pay_now').on('click',function(){
        $.ajax({
        type: 'GET',
        url: "{{guard_url('invoice/early_payments')}}/{{$order->id}}",
        beforeSend: function () {
                    $('#pay_now').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                },
        success: function () {
            toastr.success('Payment completed successfully');
            $('#pay_now').remove();
        }
        });
    });

</script>