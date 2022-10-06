            <table class="table" id="main-table" data-url="{!!guard_url('order/order?withdata=Y')!!}">
                <thead>
                    <tr>
                        <th data-field="f_name">{!! trans('order::order.label.f_name')!!}</th>
                    <th data-field="l_name">{!! trans('order::order.label.l_name')!!}</th>
                    <th data-field="total">{!! trans('order::order.label.total')!!}</th>
                    <th data-field="payment_mode">{!! trans('order::order.label.payment_mode')!!}</th>
                    <th data-field="payment_status">{!! trans('order::order.label.payment_status')!!}</th>
                        <th data-field="actions"  data-formatter="operateFormatter" class="text-right">Actions</th>
                    </tr>
                </thead>
            </table>