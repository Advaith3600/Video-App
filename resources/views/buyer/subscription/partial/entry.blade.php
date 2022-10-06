<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            {!!Form::vertical_open()
            ->id('form-create')
            ->method('POST')
            ->files('true')
            ->action(guard_url('subscribe/subscribe'))!!}

            <div class="app-entry-form-section" id="basic">
                <div class="section-title">Order Details</div>
                <div class="row">
                    <input type="hidden" name="delivery_type" value="{{$order->delivery_type}}">
                    <input type="hidden" name="seller_id" value="{{$order->seller_id}}">

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
                                <th>Products</th>
                                <th width="15%">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderproduct as $key => $value)

                            <tr>
                                <td><input type="checkbox" class="check_subscription" value="{{$value->product_id}}"
                                        name="check_subscription[{{$value->product_id}}]">
                                    <!-- <input type="hidden" name="seller_id[{{$value->product_id}}]" value="{{$order->seller_id}}" >                                    </td> -->
                                <td>{!! @$value->products->name !!}

                                </td>
                                <td><input type="number" class="form-control quantity "
                                        name="quantity[{{$value->product_id}}]" value="{{$value->quantity}}"
                                        style="width:70px;" min="1"></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>



                </div>
            </div>





        </div>


        {!!Form::close()!!}
    </div>
</div>