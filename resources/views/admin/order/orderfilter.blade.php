<thead class="list_head">
    <th style="text-align: right;" width="1%"><a class="btn-reset-filter" href="#Reset"
            style="display:none; color:#fff;"><i class="fa fa-filter"></i></a> <input type="checkbox"
            id="order-order-check-all"></th>
    <th data-field="f_name">{!! trans('order::order.label.user')!!}</th>
    <th data-field="l_name">{!! trans('order::order.label.email')!!}</th>
    <th data-field="l_name">{!! trans('address::address.label.name')!!}</th>
    <th data-field="l_name">{!! trans('address::address.label.phone')!!}</th>
    <th data-field="l_name">{!! trans('address::address.label.address_line1')!!}</th>
    <th data-field="l_name">{!! trans('address::address.label.address_line2')!!}</th>
    <th data-field="total">{!! trans('order::order.label.total')!!}</th>
    <th data-field="payment_mode">{!! trans('order::order.label.payment_mode')!!}</th>
    <th data-field="payment_status">{!! trans('order::order.label.payment_status')!!}</th>
    <th data-field="status">{!! trans('order::order.label.status')!!}</th>
    <!-- <th data-field="deleted_at">{!! trans('order::order.label.deleted_at')!!}</th> -->
</thead>
<tbody>
    @foreach($orders as $order)
    <tr>
        <!-- <td>{{$order->id}}</td> -->
        <td>{{$order->id}}</td>
        <td>{{@$order->user->name}}</td>
        <td>{{@$order->user->email}}</td>
        <td>{{@$order->address->name}}</td>
        <td>{{@$order->address->phone}}</td>
        <td>{{@$order->address->address_line1}}</td>
        <td>{{@$order->address->address_line2}}</td>
        <td>{{$order->total}}</td>
        <td>{{$order->payment_mode}}</td>
        <td>{{$order->payment_status}}</td>
        <td>{{$order->status}}</td>
        
    </tr>
    @endforeach
</tbody>