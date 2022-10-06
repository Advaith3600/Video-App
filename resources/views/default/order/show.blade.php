<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="las la-box app-sec-title-icon"></i>
        <h2>Order #{{$order->order_code}}</h2>
        <div class="actions">


        </div>

    </div>

    {!!Form::vertical_open()
    ->method('PUT')
    ->id('form-edit')
    ->action(guard_url('order/order/'. $order->getRouteKey()))!!}

    @include('order::default.order.partial.entry', ['mode' => 'edit'])


    {!!Form::close()!!}


</div>