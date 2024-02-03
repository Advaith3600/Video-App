<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="las la-box app-sec-title-icon"></i>
        <h2>Order #{{$order->order_code}} </h2>
        @if($order->coupa_po_number != null)
        <h2 class="ml-100"> Coupa PO # {{$order->coupa_po_number}} </h2>
        @endif


        <div class="" style="margin-right: 275px !important;">
            @if($order->status != "Pending" && $order->refund_status == "" && $order->payment_status == "Paid")

            <button id="refund" type="button" class="btn btn-theme">
                <i class="las la-save"></i>{{__('Refund')}}
            </button>
            @endif
            @if(!current($shipping_region))

            @if($order->status !=="Cancelled"&&$order->status =="Pending")
            &nbsp;&nbsp;&nbsp;&nbsp;
            <button id="update_button" style="" type="button" class="btn btn-theme" data-action='UPDATE'
                data-form="#form-edit" data-load-to="#app-entry" data-list="#item-list">
                <i class="las la-save"></i>{{__('Cancel Order')}}
            </button>
            @endif

            @else
            @php
            $style="";
            if($order->status != "Pending" )
            $style="display:none";
            @endphp
            &nbsp;&nbsp;&nbsp;&nbsp;
            <button id="update_button" style="{{$style}}" type="button" class="btn btn-theme" data-action='UPDATE'
                data-form="#form-edit" data-load-to="#app-entry" data-list="#item-list">
                <i class="las la-save"></i>{{__(' Confirm Order')}}
            </button>
            @endif
        </div>
    </div>

    {!!Form::vertical_open()
    ->method('PUT')
    ->id('form-edit')
    ->action(guard_url('order/order/'. $order->getRouteKey()))!!}

    @include('order::default.order.partial.entry', ['mode' => 'edit'])


    {!!Form::close()!!}


</div>

<script type="text/javascript">
// $(document).ready(function() {
//     $('#refund').click(function() {


//         $('#refund_status').val('Refund');
//         $('#update_button').click();

//     });

// });


$("#refund").on('click', function(e) {

    $('#refund_status').val('Refund');
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

});
</script>