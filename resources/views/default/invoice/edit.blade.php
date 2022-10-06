<div class="app-entry-form-wrap">
                            <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
                                <i class="las la-box app-sec-title-icon"></i>
                                <h2>Order #{{$order->order_code}}  </h2>
                                @if($order->coupa_po_number != null)
                                    <h2 class="ml-100"> Coupa PO # {{$order->coupa_po_number}}  </h2>
                                @endif

                              
                                <div class="actions " style="margin-right: 275px !important;"> 
                               
                                    
                                   
                                     
                                </div>
                            </div>

    {!!Form::vertical_open()
    ->method('PUT')
    ->id('form-edit')
    ->action(guard_url('invoice/invoice/'. $order->getRouteKey()))!!}

        @include('order::default.invoice.partial.entry', ['mode' => 'edit'])

                           
 {!!Form::close()!!}
                            
                             
    </div>

<script type="text/javascript">
$(document).ready(function() {
    $('#refund').click(function() {
       
        $('#refund_status').val('Refund');
        $('#update_button').click();
       
    });

});
</script>
