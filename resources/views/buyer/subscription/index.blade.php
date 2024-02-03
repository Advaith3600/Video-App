{!! Theme::partial('header') !!}
<style>
.pre-div {
    font-size: 14px;
    line-height: 1.5;
    font-weight: 300;
    font-family: 'Ubuntu', sans-serif;
    letter-spacing: -0.5px;

}
.form-control {
    font-size: 14px;
   
}

</style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="app-content-wrap bg-white">
    <div class="app-list-wrap">
        <div class="app-list-inner">
            <div class="header-search ">
                <div class="app-list-header d-flex align-items-center justify-content-between">
                <h3>Manage Recurring Orders </h3>
                <span class="search-btn" id="show-data"><i class="las la-search"></i></span>
                </div>
            </div>
            <div class="app-list-toolbar show-div" style="display:none">
            <!-- <form>
                <div class="header-search">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                            <input type="text" class="form-control daterange pre-div" id="created_at" name="created_at"
                                    placeholder="Date Range">
                            </div>
                        </div></br>
                        <div class="row">
                            <div class="col-md-12 pre-div">
                                {!! Form::select('order_code')
                                -> options([''=>'All']+Order::getorders()->toArray())
                                -> addClass('searchable-dropdown')
                                -> label('')
                                -> placeholder(trans('order::order.placeholder.order_code'))!!}
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 pre-div">
                            {!! Form::select('buyer')
                                -> options([''=>'All']+User::getvendors()->toArray())
                                -> addClass('searchable-dropdown')
                                -> label('')
                                -> placeholder(trans('buyer::buyer.placeholder.name'))!!}
                            </div>
                        </div></br>
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control pre-div " name="status" id="status">
                                    <option value="">Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Dispatched">Dispatched</option>
                                    <option value="Completed">Completed</option>

                                </select>
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-danger pre-div" type="reset" id="reset-btn">Clear Filter</button>
                        <button type="button" class="btn btn-theme " id="app-search" style="float: right;"><i
                                class="las la-search"></i></button>
                    </div>
                </div>
            </form> -->

            </div>

            <div class="app-items" data-url="{{guard_url('subscribe/subscribe')}}" id="item-list">
                @include('order::buyer.subscription.more', ['mode' => 'list'])
            </div>
        </div>

        <div class="app-detail-wrap" id="app-entry">

        </div>

    </div>

</div>
<style>

.select2-container .select2-selection--single {
    height: 35px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 35px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    margin-right: 5px;
}
.select2-container .select2-selection--multiple .select2-selection_arrow, .select2-container .select2-selection--single .select2-selectionarrow, .select2-container--default .select2-selection--multiple .select2-selectionarrow, .select2-container--default .select2-selection--single .select2-selection_arrow {
    top: 8px;
}
.select2-container {
    text-align: left;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    margin-right: 5px;
    top: 8px;
}
</style>