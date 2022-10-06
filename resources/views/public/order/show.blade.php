            @include('order::order.partial.header')

            <section class="single">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            @include('order::order.partial.aside')
                        </div>
                        <div class="col-md-9 ">
                            <div class="area">
                                <div class="item">
                                    <div class="feature">
                                        <img class="img-responsive center-block" src="{!!url($order->defaultImage('images' , 'xl'))!!}" alt="{{$order->title}}">
                                    </div>
                                    <div class="content">
                                        <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="id">
                    {!! trans('order::order.label.id') !!}
                </label><br />
                    {!! $order['id'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="f_name">
                    {!! trans('order::order.label.f_name') !!}
                </label><br />
                    {!! $order['f_name'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="l_name">
                    {!! trans('order::order.label.l_name') !!}
                </label><br />
                    {!! $order['l_name'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="company_name">
                    {!! trans('order::order.label.company_name') !!}
                </label><br />
                    {!! $order['company_name'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="country_id">
                    {!! trans('order::order.label.country_id') !!}
                </label><br />
                    {!! $order['country_id'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="state_id">
                    {!! trans('order::order.label.state_id') !!}
                </label><br />
                    {!! $order['state_id'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="sreet_address">
                    {!! trans('order::order.label.sreet_address') !!}
                </label><br />
                    {!! $order['sreet_address'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="apartment">
                    {!! trans('order::order.label.apartment') !!}
                </label><br />
                    {!! $order['apartment'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="zip_code">
                    {!! trans('order::order.label.zip_code') !!}
                </label><br />
                    {!! $order['zip_code'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="json_data">
                    {!! trans('order::order.label.json_data') !!}
                </label><br />
                    {!! $order['json_data'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="subtotal">
                    {!! trans('order::order.label.subtotal') !!}
                </label><br />
                    {!! $order['subtotal'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="total">
                    {!! trans('order::order.label.total') !!}
                </label><br />
                    {!! $order['total'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="payment_mode">
                    {!! trans('order::order.label.payment_mode') !!}
                </label><br />
                    {!! $order['payment_mode'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="payment_status">
                    {!! trans('order::order.label.payment_status') !!}
                </label><br />
                    {!! $order['payment_status'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="status">
                    {!! trans('order::order.label.status') !!}
                </label><br />
                    {!! $order['status'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="created_at">
                    {!! trans('order::order.label.created_at') !!}
                </label><br />
                    {!! $order['created_at'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="deleted_at">
                    {!! trans('order::order.label.deleted_at') !!}
                </label><br />
                    {!! $order['deleted_at'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="updated_at">
                    {!! trans('order::order.label.updated_at') !!}
                </label><br />
                    {!! $order['updated_at'] !!}
            </div>
        </div>
    </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('f_name')
                       -> label(trans('order::order.label.f_name'))
                       -> placeholder(trans('order::order.placeholder.f_name'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('l_name')
                       -> label(trans('order::order.label.l_name'))
                       -> placeholder(trans('order::order.placeholder.l_name'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('company_name')
                       -> label(trans('order::order.label.company_name'))
                       -> placeholder(trans('order::order.placeholder.company_name'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::numeric('country_id')
                       -> label(trans('order::order.label.country_id'))
                       -> placeholder(trans('order::order.placeholder.country_id'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::numeric('state_id')
                       -> label(trans('order::order.label.state_id'))
                       -> placeholder(trans('order::order.placeholder.state_id'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('sreet_address')
                       -> label(trans('order::order.label.sreet_address'))
                       -> placeholder(trans('order::order.placeholder.sreet_address'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('apartment')
                       -> label(trans('order::order.label.apartment'))
                       -> placeholder(trans('order::order.placeholder.apartment'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('zip_code')
                       -> label(trans('order::order.label.zip_code'))
                       -> placeholder(trans('order::order.placeholder.zip_code'))!!}
                </div>

                <div class='col-md-12'>
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
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::decimal('total')
                       -> label(trans('order::order.label.total'))
                       -> placeholder(trans('order::order.placeholder.total'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::select('payment_mode')
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



