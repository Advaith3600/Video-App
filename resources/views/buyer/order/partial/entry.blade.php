<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">

            {!!Form::vertical_open()
            ->id('form-create')
            ->method('POST')
            ->files('true')
            ->action(guard_url('order/order'))!!}

            <div class="app-entry-form-section" id="basic">
                <div class="section-title">Order Details</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="task_title">Order ID</label>
                            {!! Form::text('order_id')
                            -> label(trans('order::order.label.order_id'))
                            ->required()
                            ->addClass('form-control ')
                            ->placeholder(trans('order::order.placeholder.order_id'))
                            ->raw()!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="task_title">Full Name</label>
                            {!! Form::text('f_name')
                            ->label(trans('order::order.label.f_name'))
                            ->required()
                            ->addClass('form-control ')
                            ->placeholder(trans('order::order.placeholder.f_name'))
                            ->raw()!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="task_title">Email</label>

                            {!! Form::email('email')
                            ->label(trans('order::order.label.email'))
                            ->required()
                            ->addClass('form-control')
                            ->placeholder(trans('order::order.placeholder.email'))
                            ->raw()!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="task_title">Telephone</label>
                            {!! Form::number('telephone')
                            ->label(trans('order::order.label.telephone'))
                            ->required()
                            ->addClass('form-control')
                            ->placeholder(trans('order::order.placeholder.telephone'))
                            ->raw()!!}
                        </div>
                    </div>

                </div>
            </div>
            <div class="app-entry-form-section" id="payment">
                <div class="section-title">Payment</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">

                            {!! Form::select('payment_status[]')
                            ->id('payment-dropdown')
                            ->options(['Payed' => 'Payed','Not Payed' => 'Not Payed'])
                            ->addClass('select2')
                            ->label(trans('order::order.label.payment_status')) !!}

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="task_title">Payment Tracking ID</label>
                            {!! Form::text('pay_tracking_id')
                            ->label(trans('order::order.label.pay_tracking_id'))
                            ->addClass('form-control')
                            ->placeholder(trans('order::order.placeholder.pay_tracking_id'))
                            ->raw()!!}

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="task_title">Bank Ref No</label>

                            {!! Form::text('bank_ref_no')
                            ->label(trans('order::order.label.bank_ref_no'))
                            ->addClass('form-control')
                            ->placeholder(trans('order::order.placeholder.bank_ref_no'))
                            ->raw()!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="task_title">Card Name</label>
                            {!! Form::text('card_name')
                            ->label(trans('order::order.label.card_name'))
                            ->addClass('form-control')
                            ->placeholder(trans('order::order.placeholder.card_name'))
                            ->raw()!!}

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="task_title">Payment Method</label>

                            {!! Form::select('payment_mode[]')
                            ->label(trans('order::order.label.payment_mode'))
                            ->options(['Direct payment' => 'Direct payment','Check payment' => 'Check payment','Cash on
                            delivery'=>'Cash on delivery'])
                            ->addClass('form-control')
                            ->placeholder(trans('order::order.placeholder.payment_mode'))!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="task_title">Transaction Amount</label>

                            {!! Form::text('total')
                            ->label(trans('order::order.label.total'))
                            ->addClass('form-control')
                            ->placeholder(trans('order::order.placeholder.total'))
                            ->raw()!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="task_title">Payment Currency</label>

                            {!! Form::text('payment_currency')
                            ->label(trans('order::order.label.payment_currency'))
                            ->addClass('form-control')
                            ->placeholder(trans('order::order.placeholder.payment_currency'))
                            ->raw()!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-entry-form-section" id="settings">
                <div class="section-title">Shipping</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="task_title">Shipping Code</label>

                            {!! Form::text('shipping_code')
                            -> label(trans('order::order.label.shipping_code'))
                            ->addClass('form-control')
                            -> placeholder(trans('order::order.placeholder.shipping_code'))
                            ->raw()!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="task_title">Shipping Method</label>

                            {!! Form::text('shipping_method')
                            -> label(trans('order::order.label.shipping_method'))
                            ->addClass('form-control')
                            -> placeholder(trans('order::order.placeholder.shipping_method'))
                            ->raw()!!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="task_title">Shipping Address</label>

                            {!! Form::text('shipping_address')
                            -> label(trans('order::order.label.shipping_address'))
                            ->addClass('form-control')
                            -> placeholder(trans('order::order.placeholder.shipping_address'))
                            ->raw()!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-entry-form-section" id="products">
                <div class="section-title">Products</div>
                <div class="row layout-wrap">
                    <div class="col-12 list-item list-item-thumb">
                        <div class="card d-flex flex-row mb-3 border">
                            <a class="d-flex card-img" href="#">
                                <img src="img/products/1.jpg" alt="Donec sit amet est at sem iaculis aliquam."
                                    class="list-thumbnail responsive border-0">
                            </a>
                            <div class="d-flex flex-grow-1 min-width-zero card-content">
                                <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                    <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="#">Smart Watches 3
                                        SWR50</a>
                                    <p class="mb-1 text-muted text-small category w-15 w-xs-100">Workwear</p>
                                    <p class="mb-1 text-muted text-small date w-15 w-xs-100">$49.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 list-item list-item-thumb">
                        <div class="card d-flex flex-row mb-3 border">
                            <a class="d-flex card-img" href="#">
                                <img src="img/products/2.jpg" alt="Donec sit amet est at sem iaculis aliquam."
                                    class="list-thumbnail responsive border-0">
                            </a>
                            <div class="d-flex flex-grow-1 min-width-zero card-content">
                                <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                    <a class="list-item-heading mb-1  w-40 w-xs-100" href="#">ZenBook 3 Ultrabook 8GB
                                        512SSD W10</a>
                                    <p class="mb-1 text-muted text-small category w-15 w-xs-100">Workwear</p>
                                    <p class="mb-1 text-muted text-small date w-15 w-xs-100">$49.00</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="app-entry-form-section" id="status">
                <div class="section-title">Status</div>
                <div class="pipeline-wrap pb-50">
                    <div class="pipeline-spreads">
                        <div class="listing-stages">
                            <div class="listing-stage">
                                <div class="listing-stage-label-container">
                                    <div class="listing-stage-label">
                                        <div><span>Move to: </span>Pending</div>
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
                            <div class="listing-stage active">
                                <div class="listing-stage-label-container">
                                    <div class="listing-stage-label">
                                        <div><span>Move to: </span>Processing</div>
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
                            <div class="listing-stage empty">
                                <div class="listing-stage-label-container">
                                    <div class="listing-stage-label">
                                        <div><span>Move to: </span>Dispatched</div>
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
                            <div class="listing-stage empty">
                                <div class="listing-stage-label-container">
                                    <div class="listing-stage-label">
                                        <div><span>Move to: </span>Shipped</div>
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
                            <div class="listing-stage empty">
                                <div class="listing-stage-label-container">
                                    <div class="listing-stage-label">
                                        <div><span>Move to: </span>On The Way</div>
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
                            <div class="listing-stage empty">
                                <div class="listing-stage-label-container">
                                    <div class="listing-stage-label">
                                        <div><span>Move to: </span>Out For Delivery</div>
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
                            <div class="listing-stage empty">
                                <div class="listing-stage-label-container">
                                    <div class="listing-stage-label">
                                        <div><span>Move to: </span>Delivered</div>
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
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-3 d-none d-md-block">
            <aside class="app-create-steps">
                <h5 class="steps-header">Steps</h5>
                <div class="steps-wrap" id="steps_nav">
                    <a class="step-item active" href="#basic"><span>1</span> Order Details</a>
                    <a class="step-item" href="#payment"><span>2</span> Payment</a>
                    <a class="step-item" href="#products"><span>3</span> Products</a>
                    <a class="step-item" href="#status"><span>4</span> Status</a>
                </div>
            </aside>
        </div>

        {!!Form::close()!!}
    </div>
</div>
