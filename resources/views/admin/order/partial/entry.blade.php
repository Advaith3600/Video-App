            <div class='row'>
                <div class='col-md-4 col-sm-6'>
                    {!! Form::text('username')
                    -> disabled()
                    -> value($order->user['name'])
                    -> label(trans('order::order.label.user'))
                    -> placeholder(trans('order::order.placeholder.user'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::text('email')
                    -> disabled()
                    -> value($order->user['email'])
                    -> label(trans('order::order.label.l_name'))
                    -> placeholder(trans('order::order.placeholder.l_name'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::text('name')
                    -> disabled()
                    -> value($order->address['name'])
                    -> label(trans('address::address.label.name'))
                    -> placeholder(trans('address::address.placeholder.name'))!!}
                </div>
                <div class='col-md-4 col-sm-6'>
                    {!! Form::text('phone')
                    -> disabled()
                    -> value($order->address['phone'])
                    -> label(trans('address::address.label.phone'))
                    -> placeholder(trans('address::address.placeholder.phone'))!!}
                </div>
                <div class='col-md-4 col-sm-6'>
                    {!! Form::text('address1')
                    -> disabled()
                    -> value($order->address['address_line1'])
                    -> label(trans('address::address.label.address_line1'))
                    -> placeholder(trans('address::address.placeholder.address_line1'))!!}
                </div>
                <div class='col-md-4 col-sm-6'>
                    {!! Form::text('address2')
                    -> disabled()
                    -> value($order->address['address_line1'])
                    -> label(trans('address::address.label.address_line2'))
                    -> placeholder(trans('address::address.placeholder.address_line1'))!!}
                </div>
                <!-- <div class='col-md-4 col-sm-6'>
                       {!! Form::text('zip_code')
                       -> value($order->address['postal_code'])
                       -> label(trans('order::order.label.zip_code'))
                       -> placeholder(trans('order::order.placeholder.zip_code'))!!}
                </div>
                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('district')
                       -> label(trans('order::order.label.country_id'))
                       -> placeholder(trans('order::order.placeholder.country_id'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('state')
                       -> label(trans('order::order.label.state_id'))
                       -> placeholder(trans('order::order.placeholder.state_id'))!!}
                </div> -->

                <!-- <div class='col-md-4 col-sm-6'>
                       {!! Form::text('sreet_address')
                       -> label(trans('order::order.label.sreet_address'))
                       -> placeholder(trans('order::order.placeholder.sreet_address'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('apartment')
                       -> label(trans('order::order.label.apartment'))
                       -> placeholder(trans('order::order.placeholder.apartment'))!!}
                </div> -->



                <!-- <div class='col-md-12'>
                    {!! Form::textarea('json_data')
                    -> label(trans('order::order.label.json_data'))
                    -> dataUpload(trans_url($order->getUploadURL('json_data')))
                    -> addClass('html-editor')
                    -> placeholder(trans('order::order.placeholder.json_data'))!!}
                </div>
                <div class='col-md-4 col-sm-6'>
                       {!! Form::decimal('subtotal')
                       -> label(trans('order::order.label.subtotal'))
                       -> placeholder(trans('order::order.placeholder.subtotal'))!!}
                </div> -->

                <div class='col-md-4 col-sm-6'>
                    {!! Form::decimal('total')
                    -> disabled()
                    -> label(trans('order::order.label.total'))
                    -> placeholder(trans('order::order.placeholder.total'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::select('payment_mode')
                    -> disabled()
                    -> options(trans('order::order.options.payment_mode'))
                    -> label(trans('order::order.label.payment_mode'))
                    -> placeholder(trans('order::order.placeholder.payment_mode'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::select('payment_status')
                    -> options(trans('order::order.options.payment_status'))
                    -> label(trans('order::order.label.payment_status'))
                    -> placeholder(trans('order::order.placeholder.payment_status'))!!}
                </div>
                <div class='col-md-4 col-sm-6'>
                    {!! Form::select('status')
                    -> options(trans('order::order.options.status'))
                    -> label(trans('order::order.label.status'))
                    -> placeholder(trans('order::order.placeholder.status'))!!}
                </div>
            </div>