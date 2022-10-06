<style>
.error{
  border: 1px solid red;
}

</style>
<link media="all" type="text/css" rel="stylesheet" href="{{theme_asset('css/profile.css')}}">
<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="las la-box app-sec-title-icon"></i>
        <h2>Order #{{@$order->order_code}}</h2>
        @if($order->coupa_po_number != null)
            <h2 class="ml-100"> Coupa PO # {{$order->coupa_po_number}}  </h2>
        @endif
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @if($order->status !=="Cancelled"&&$order->status =="Pending")                                   
            <button id="update_button" style="" type="button" class="btn btn-theme" data-action='UPDATE'
                data-form="#form-update" data-load-to="#app-entry" data-list="#item-list">
                <i class="las la-save"></i>{{__('Cancel Order')}}
            </button>
            {!!Form::vertical_open()
            ->method('PUT')
            ->id('form-update')
            ->action(guard_url('order/order/'. $order->getRouteKey()))!!}

                <input type="hidden" name="status" value="Cancelled">            
             {!!Form::close()!!}
        @endif
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 d-none d-md-block">
                <form class="app-entry-form pl-0 pr-0" action="">
                    @php
                    $order_status = trans('order::order.options.status');
                    $order_key = array_search($order->status,$order_status);
                    @endphp
                    <div class="app-entry-form-section" id="status">
                        <div class="section-title" style="margin:10px;"> {{trans('order::order.label.status')}}</div>
                        <div class="pipeline-wrap pb-50 mt-40">
                            <div class="pipeline-spreads">
                                <div class="listing-stages">
                                    @if($order->status!="Cancelled")
                                        @foreach($order_status as $key => $value)

                                        @php
                                        $class ="";

                                        if($order_key == $key){
                                        $class ="active";

                                        }
                                        if($order_key < $key){ $class="empty" ; } @endphp 
                                        <div class="listing-stage {{$class}}">
                                            <input type="hidden" class="key" value="{{$key}}">
                                            <input type="hidden" class="status" value="{{$value}}">

                                            <div class="listing-stage-label-container">
                                                <div class="listing-stage-label">
                                                @if($class=="active")
                                                    <div>{{$value}}</div>
                                                @endif
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
                                @else
                                    <span class="text-danger">Order Cancelled</span> 
                                @endif
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="order_status" name="status" value="{{$order->status}}">
                    </div>
                    
                    @if($order->status == "Dispatched")
                     <div class="app-entry-form-section" id="product">
                        <div class="section-title"><h6>Delivery Information</h6></div>
                        <div class="row">
                            <div class="col-12 list-item list-item-thumb">
                                <div class="card d-flex flex-row mb-3 border ">
                                    <div class="col-md-12 mt-20">

                                        
                                        <p> Tracking Code :<span> {{$order->delivery_track_code}} </span></p>
                                        <p> Tracking Link :<span> <a href="{{$order->delivery_track_link}}">{{$order->delivery_track_link}}</a> </span></p>
                                        <p>
                                            
                                            Description :<label> {{$order->delivery_description}} </label>
                                        </p>
                                    </div>

                                    
                                </div>


                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="app-entry-form-section" id="product">
                        <div class="section-title">Products</div>
                        <div class="row layout-wrap">
                            @foreach($order->orderproduct as $key => $value)
                            @php
                            $title = @$value->products->name;
                            if(@$value->products->images){
                            $title = current($value->products->images)['title'];
                            }
                            @endphp 
                            <div class="col-12 list-item list-item-thumb list-prodcut">
                                <div class="card d-flex flex-row mb-3 border">
                                    <a class="d-flex card-img" href="{{trans_url('products/' . @$value->products->getRouteKey())}}">
                                        <img src="{{ $value->products!=null?trans_url($value->products->defaultImage('images' , 'original')):''}}"
                                            alt="{{$title}}" class="list-thumbnail responsive border-0">
                                    </a>
                                    <div class="d-flex flex-grow-1 min-width-zero card-content">
                                        <div
                                            class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                            <a class="list-item-heading mb-1 truncate w-30 w-xs-100"
                                                href="{{trans_url('products/' . @$value->products->getRouteKey())}}">{{@$value->products->name}}</a>
                                            <input type="hidden" class="form-control online_price" id=""
                                                value="{{@$value->unit_price}}" disabled="">
                                            @if($order->status == "Pending")
                                            <div class="form-group w-5 w-xs-100">
                                                <label for=""> Quantity</label>
                                                {!! Form::number("quantity[".@$value->products->id."]")
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
                                                {{ number_format($value->unit_price,2)}}
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
                        <div class="section-title">Receipt Goods</div>
                       
                       
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Supplier</th>
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
                                                <td>{!! @$value->products->user->name !!}</td>
                                                <td><input type="number" name="quantity[]" id="quantity_{{$value->id}}" value="{{$value->quantity}}"  style="width:70px;" disabled> </td>
                                                <td><input type="number" quantity="{{$value->quantity}}" class="received" name="received[]" id="{{$value->id}}" value="{{$value->received}}" 
                                                style="width:70px;" min="0" max="{{$value->quantity}}" {{$value->quantity==$value->received?'disabled':''}}></td>
                                                <td><input type="number" name="pending[]" id="pending_{{$value->id}}" style="width:70px;" value="{{$value->pending}}" readonly></td>
                                                <td><textarea type="text" name="notes[]" id="notes" {{$value->quantity==$value->received?'disabled':''}}>{{$value->notes}}</textarea>
                                                <input type="hidden" id="order_id_{{$value->id}}" name="order_id[]" value="{{$value->id}}">
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align:right;">
                                <button type="button" class="btn btn-with-icon btn-theme" id="process-btn"><i class="fa fa-plus" aria-hidden="true"></i></i> Process</button>
                            </div>
                        </div></br>
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
                        <div class="section-title">Recurring Order</div>
                        <div class="row">

                        
                            <div class="col-md-12" style="text-align:right;">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;Recurring Order :</span>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="switch">
                                            <input type="checkbox" class="subscribe_button" {{@$Subscription == 'on' ? "checked='checked'" : ''}} >
                                            <div class="slider round">
                                                <span class="on">Yes </span><span class="off">&nbsp;&nbsp; No</span>
                                            </div>
                                        </label>
                                    </div>
                                </div> 
                                <br>
                                <div class="form-group order_details_show">
                                <button type="button" class="btn btn-with-icon btn-theme" id="subscribe"><i class="fa fa-plus" aria-hidden="true"></i> Add Order Details</button>

                                </div>
                                @if(@$Subscription == 'on')
                                <table class="table table-bordered table_details">
                                    <thead>
                                        <tr>
                                            <th  width="8%"> </th>
                                            <th >Products</th>
                                            <th width="15%" >Quantity</th>
                                            <th>Delivery Type</th>
                                            <th>Subscription Interval</th>
                                            <!-- <th>Actions</th> -->
                                        </tr>  
                                    </thead>
                                    <tbody>
                                    
                                    @foreach(@$subscribe as $key => $value) 
                                
                                        <tr>
                                        <td>  <input type="checkbox" class="check_subscription"{{'checked'}} value="{{$value->product_id}}" name="check_subscription[{{$value->product_id}}]" >
                                            <input type="hidden" name="seller_id[{{$value->product_id}}]" value="{{@$value->seller_id}}" > </td>                                  
                                            <td>{!! @$value->name !!}
                                                
                                            </td>
                                            <td>{{@$value->quantity}}</td>
                                            <td>{{@$value->deliveryType}}</td>
                                            <td id="intervel_text" class="intervel_text">{{(@$value->repeat_interval=='1-W'?' 1 week' :'')}}
                                    {{(@$value->repeat_interval=='2-W'?'2 week' :'')}}
                                    {{(@$value->repeat_interval=='1-M'?'1 month' :'')}}
                                    {{(@$value->repeat_interval=='2-M'?'2 months' :'')}}
                                    {{(@$value->repeat_interval=='3-M'?'3 months' :'')}} 
                                    {{(@$value->repeat_interval=='6-M'?' 6 months' :'')}}
                                    {{(@$value->repeat_interval=='1-Y'?'1 year' :'')}} </td>
                                            <!-- <td>
                                                <div class="list-actions" style="opacity: 1; visibility: visible;">
                                                <a href="{{guard_url('subscribe/subscribe?id='.@$value->id)}}"  id="subscribe_edit"><i class="las la-pencil-alt"></i></a>
                                            </td> -->
                                        </tr>  
                                    @endforeach
                                    
                                    </tbody>
                                </table>   
                                @endif  
                            </div>
                        </div></br>
                    </div>
                </form>
            </div>
            <div class="col-md-3 d-none d-md-block">
                <aside class="app-create-steps">
                    <h5 class="steps-header">Steps</h5>
                    <div class="steps-wrap" id="steps_nav">
                        <a class="step-item  active" href="#status"><span>1</span> Delivery Status</a>
                        <a class="step-item " href="#product"><span>2</span> Products</a>
                        <a class="step-item " href="#order"><span>3</span> Order Details</a>

                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg modal-dialog-centered modal-dialog-scrollable" >
        <div class="modal-content">
          <form name="form_subscrption" id="form_subscrption">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accountModalLabel">Order Subscrption</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                <div class="modal-body">
                <input type="hidden" name="delivery_type" value="{{$order->delivery_type}}" >                                    
                 <input type="hidden" name="seller_id" value="{{$order->seller_id}}" >                                    

                    <div class="form-group col-md-3">
                        <label for="task_title">Deliver every</label>
                        <select name="repeat_interval" class="form-control" id="repeat_interval">
                            <option value="1-W"> 1 week</option>
                            <option value="2-W"> 2 week</option>
                            <option value="1-M"> 1 month</option>
                            <option value="2-M"> 2 months</option>
                            <option value="3-M"> 3 months</option>
                            <option value="6-M"> 6 months</option>
                            <option value="1-Y"> 1 year</option>
                        </select>
                    </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="8%"></th>
                                    <th >Products</th>
                                    <th width="15%" >Quantity</th>
                                </tr>  
                            </thead>
                            <tbody>
                            @foreach($order->orderproduct as $key => $value) 
                          
                                <tr>
                                    <td><input type="checkbox" class="check_subscription" value="{{$value->product_id}}" name="check_subscription[{{$value->product_id}}]" >
                                    <!-- <input type="hidden" name="seller_id[{{$value->product_id}}]" value="{{$order->seller_id}}" >                                    </td> -->
                                    <td>{!! @$value->products->name !!}
                                        
                                    </td>
                                    <td><input type="number" class="form-control quantity " name="quantity[{{$value->product_id}}]" value="{{$value->quantity}}" style="width:70px;" min="1"></td>
                                </tr>  
                            @endforeach

                            </tbody>
                        </table>     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="save_subscription" name="save_subscription" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.received').on('input',function(){
        $quantity = $(this).attr('quantity');
        $received = $(this).val();
        if($quantity < $received){
            toastr.warning('Given number is invalid');
            $(this).addClass('error');
        }else{
            $(this).removeClass('error');
            $('#pending_'+$(this).attr('id')).val($quantity - $received);

        }
    });
    $('#process-btn').on('click',function(){

       var error_check = false;
        $('.received').each(function(){
            if($(this).hasClass('error') == true){
                error_check = true;
            }
        });
        if(!error_check ){
         

            var order_id = $("input[name='order_id[]']").val();
            var received = $("input[name='received[]']").val();
            var pending = $("input[name='pending[]']").val();
            var notes = $("input[name='notes[]']").val();
            var data = $(":input").serializeArray();
            $.ajax({
            type: 'GET',
            url: "{{guard_url('order-update')}}",
            data: data,
            success: function () {
                toastr.success('updated successfully');
            }
            });

        }else{
            toastr.warning('invalid  recieved inputs');

        }
        
    });
    $('#subscribe').click(function(){
        $('#subscribeModal').modal('show');
    });

    $('#save_subscription').click(function(){
        $.ajax({
            type: 'GET',
            url: "{{guard_url('subscribe/create_subscription')}}",
            data:$('#form_subscrption').serialize(),
            success: function (result) {
                
              
                   $('#subscribeModal').modal('toggle');
                   $(".app-entry-form-wrap").load('{{guard_url('order/order/'.@$order->getRouteKey().'/edit')}}');
               
                 
            }
            });
    });
    @if(@$Subscription=='on') 
            $('.order_details_show').show();
         @else 
            $('.order_details_show').hide();
        @endif
    $('.subscribe_button').on('change', function() {
        if ($(this).is(":checked")) {
            $('.order_details_show').show();
        } else {
            $('.order_details_show').hide();
        }

    });
    
</script>