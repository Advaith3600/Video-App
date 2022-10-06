<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div id="pagination-list">
    <div id="advanced_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
        <div class="datatable-header-filter-wrap">
            <div class="d-flex">
                <div class="filter-item">
                    <div class="dataTables_length" id="advanced_table_length"><label>Show
                            <select name="advanced_table_length" aria-controls="advanced_table"
                                class="custom-select custom-select-sm form-control form-control-sm" id="pageLimit">
                                <option value="10" {{$pageLimit==10?'selected':''}}>10</option>
                                <option value="25" {{$pageLimit==25?'selected':''}}>25</option>
                                <option value="50" {{$pageLimit==50?'selected':''}}>50</option>
                                <option value="100" {{$pageLimit==100?'selected':''}}>100</option>
                            </select> entries</label>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="filter-item">
                    <div id="advanced_table_filter" class="dataTables_filter">
                        {!! Form::text('invoice_number')
                        ->label('')
                        ->required()
                        ->addClass('form-control-sm')
                        ->placeholder('search by invoice number..')
                        ->raw()!!}
                    </div>
                </div>
                @php $user_id=user_id() ;
               
                @endphp
                <div class="filter-item">
                    <div id="advanced_table_filter" class="dataTables_filter">
                        {!! Form::select('user_id')
                        ->label('')
                        ->required()
                        ->addClass('searchable-dropdown form-control-sm')
                        ->options(User::getSupplierBuyers($user_id)->toArray())
                        ->style('width','150px;')
                        ->placeholder('search company name..')
                        ->raw()!!}
                    </div>
                </div>
                <div class="filter-item">
                    <div id="advanced_table_filter" class="dataTables_filter">
                        {!! Form::text('created_at')
                        ->label('')
                        ->required()
                        ->addClass('form-control-sm daterange')
                        ->placeholder('search by date range..')
                        ->raw()!!}
                    </div>
                </div>
                <div class="filter-item">
                    <div id="advanced_table_filter" class="dataTables_filter">
                        {!! Form::select('payment_status')
                        ->addClass('form-control-sm')
                        ->options(trans('order::order.options.payment_status1'))
                        ->style('text-align','left')
                        ->placeholder('search payment status..')
                        ->label('') !!}
                    </div>
                </div>
                <div class="filter-item">
                    <div id="advanced_table_filter" class="dataTables_filter">
                        {!! Form::text('coupa_po_number')
                        ->label('')
                        ->required()
                        ->addClass('form-control-sm')
                        ->placeholder('search by PO number..')
                        ->raw()!!}
                    </div>
                </div>
                <div class="filter-item">
                    <button class="btn btn-danger" id="clear-filter"><i class="fas fa-filter"></i> Clear</button>
                </div>
                <div class="filter-item">
                    <form action="{{ guard_url('invoice/invoice') }}" method="GET" enctype="multipart/form-data">
                        <input type="hidden" name="download" value="yes">
                        @foreach($search as $key=>$value)
                        @if($value!=null)
                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                        @endif
                        @endforeach
                        <button type="{{$search==null?'button':'submit'}}" class="btn btn-warning" 
                            data-toggle="tooltip" data-placement="bottom"
                            title="Apply search criteria such as payment status and date range prior to downloading excel"><i class="las la-download"></i>Download
                            </button>
                        </form>
                </div>
            </div>
        </div>
        <div class="row" id="dvdata">
            <div class="col-sm-12">
                <table id="advanced_table" class="table dataTable no-footer" role="grid"
                    aria-describedby="advanced_table_info">
                    <thead>
                        <tr role="row">
                            <th width="10" rowspan="1" colspan="1" aria-label="&amp;nbsp;" style="width: 28px;">
                                No
                            </th>
                            <th tabindex="0" aria-controls="advanced_table" rowspan="1" colspan="1"
                                aria-label="#: activate to sort column ascending" style="width: 201px;">Invoice Number
                            </th>
                            <th tabindex="0" aria-controls="advanced_table" rowspan="1" colspan="1"
                                aria-label="Name: activate to sort column ascending" style="width: 190px;">Buyer Name
                            </th>

                            <th tabindex="0" aria-controls="advanced_table" rowspan="1" colspan="1"
                                aria-label="Order Date: activate to sort column ascending" style="width: 195px;">Issue
                                Date
                            </th>
                            <th tabindex="0" aria-controls="advanced_table" rowspan="1" colspan="1"
                                aria-label="Status: activate to sort column ascending" style="width: 171px;">Due Date
                            </th>
                            <th tabindex="0" aria-controls="advanced_table" rowspan="1" colspan="1"
                                aria-label="Payment Status: activate to sort column ascending" style="width: 262px;">
                                Payment
                                Status</th>
                            <th tabindex="0" aria-controls="advanced_table" rowspan="1" colspan="1"
                                aria-label="Payment Status: activate to sort column ascending" style="width: 262px;">
                                PO Number
                            </th>
                            <th tabindex="0" aria-controls="advanced_table" rowspan="1" colspan="1"
                                aria-label="Amount: activate to sort column ascending" style="width: 157px;">Amount</th>
                            <th class="text-right" tabindex="0" aria-controls="advanced_table" rowspan="1" colspan="1"
                                aria-label="Actions: activate to sort column ascending" style="width: 175px;">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key=>$value)
                        <tr role="row" class="odd">
                            <td class="sorting_1">{{$key+1}}</td>
                            <td>{{@$value->invoice_number}}</td>
                            <td>{{@$value->user->company_name}}</td>
                            <td>{{date('d M y',strtotime($value->created_at))}}</td>
                            <td>{{date('d M y',strtotime($value->created_at->addDays(@$value->seller->payment_terms_delay)))}}
                            </td>

                            <td><span
                                    class="label label-{{@$value->payment_status=='Paid'?'success':''}}{{@$value->payment_status=='Pending'?'warning':''}}{{@$value->payment_status=='Not Paid'?'danger':''}}{{@$value->payment_status=='Failed'?'danger':''}}{{@$value->payment_status=='Bank Processing'?'primary':''}}"
                                    {{@$value->payment_status=='Batched'?'style=background-color:#e4e444;':''}}{{@$value->payment_status=='Not Paid'?'style=background-color:#32efdd;':''}}>{{@$value->payment_status}}</span>
                            </td>
                            <td>{{@$value->coupa_po_number}}</td>
                            <td>${{@number_format($value->amount)}}</td>
                            <td class="text-right">
                                <div class="table-actions">
                                    @if(user()->isBuyer()&&$value->payment_status=='Not Paid')
                                    <a class="btn btn-primary" id="{{$value->id}}"
                                        href="{{trans_url('buyer/coupa_invoice/$hash_id');}}" target="_blank">Pay</a>
                                    @endif
                                    @if(user()->isBuyer()&&$value->payment_status=='Not
                                    Paid'&&$value->order_status=='Confirmed')
                                    <button class="btn btn-primary" id="{{$value->id}}">Pay</button>
                                    @endif
                                    <a href="{{guard_url('order/order?id='.hashids_encode($value->id))}}"
                                        data-toggle="tooltip" data-placement="left" title=""
                                        data-original-title="View Order"><i class="las la-box"></i></a>
                                    <a class="invoiceview" id="{{$value->getRoutekey()}}" data-toggle="modal"
                                        data-backdrop="static" data-target="#invoiceModal" data-placement="left"
                                        title="View Invoice" data-original-title="View Invoice" target="_blank"><i
                                            class="las la-eye"></i></a>
                                    <a href="{{guard_url('invoice/download_invoice/'.$value->id)}}"
                                        data-toggle="tooltip" data-placement="left" title=""
                                        data-original-title="Download Invoice"><i class="las la-download"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="advanced_table_info" role="status" aria-live="polite"
                    style="align:right;">Showing
                    {{($data->links()->paginator->currentPage()-1)*$data->links()->paginator->perPage()+1}} to
                    {{($data->links()->paginator->currentPage()-1)*$data->links()->paginator->perPage()+count($data->links()->paginator->items())}}
                    of {{$data->links()->paginator->total()}}
                    entries</div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="advanced_table_paginate">
                    {!!$data->links('order::buyer.invoice.pagination',['elements'=>$data->links()])!!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer text-center">
                
                    <p class="centered" style="font-weight: normal; line-height: 28px">Powered by b2buy.online</p>
                
            </div>
            <!-- <div class="modal-footer text-center" style="font-size: 13px; line-height: 28px; color: #3c4858; text-align: center; font-weight: normal; font-style: normal; text-decoration: none; ">
                
                    <p class="centered">Powered by b2buy.online</p>
                
            </div> -->
        </div>
    </div>
</div>
<script>
    $(document).ready( function(){
        $(".invoiceview").on("click", function(){
            $(".modal-body").load("{{guard_url('invoice/view_invoice/')}}"+'/'+$(this).attr('id')+"{{'?view'}}");
        });
        $('.daterange').daterangepicker({
            locale: {
            format: 'DD/MM/YYYY',
            placeholder:'Select a range',
        }  
        });
        $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
            $('#created_at').val('');
        });
        $('.daterange').on('apply.daterangepicker', function(ev, picker) {
            $(document).trigger('myCustomEvent');
        });
        $('#created_at').val('');

    });
    $("#pageLimit").on('change',function(){
        $("#pagination-list").load("{{guard_url('invoice/invoice?pageLimit=')}}"+$(this).val());
    });
    $('.pay_now').on('click',function(){
        $.ajax({
        type: 'GET',
        url: "{{guard_url('invoice/early_payments')}}"+'/'+$(this).attr('id'),
        beforeSend: function () {
                    $('#pay_now').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                },
        success: function () {
            toastr.success('Payment completed successfully');
            $('#pay_now').remove();
        }
        });
    });
    $('#payment_status,#invoice_number,#coupa_po_number,#user_id').on('change',function(){
        var payment_status = $("#payment_status").val();
        var invoice_number = $("#invoice_number").val();
        var user_id = $("#user_id").val();
        var created_at = $('#created_at').datepicker('option', {dateFormat: 'dd/mm/yy'}).val();
        var start_date ="";
        var end_date ="";
        if(created_at){
            var date = created_at.split('-');
            start_date = date[0].trim();
            end_date = date[1].trim();
        }
        var coupa_po_number = $("#coupa_po_number").val();

        $.ajax({
        type: 'GET',
        url: "{{guard_url('invoice/invoice')}}",
        data : {payment_status:payment_status,user_id:user_id,start_date:start_date,end_date:end_date,coupa_po_number:coupa_po_number,invoice_number:invoice_number},
        success: function (data) {
            $('#pagination-list').html(data);
        }
        });
        
    });
    $(document).on('myCustomEvent', function () {
        var payment_status = $("#payment_status").val();
        var invoice_number = $("#invoice_number").val();
        var user_id = $("#user_id").val();
        var created_at = $('#created_at').datepicker('option', {dateFormat: 'dd/mm/yy'}).val();
        var start_date ="";
        var end_date ="";
        if(created_at){
            var date = created_at.split('-');
            start_date = date[0].trim();
            end_date = date[1].trim();
        }
        var coupa_po_number = $("#coupa_po_number").val();

        $.ajax({
        type: 'GET',
        url: "{{guard_url('invoice/invoice')}}",
        data : {payment_status:payment_status,user_id:user_id,start_date:start_date,end_date:end_date,coupa_po_number:coupa_po_number,invoice_number:invoice_number},
        success: function (data) {
            $('#pagination-list').html(data);
        }
        });
        
    });

    $('#clear-filter').on('click',function(){
        $.ajax({
        type: 'GET',
        url: "{{guard_url('invoice/invoice')}}",
        success: function (data) {
            $('#pagination-list').html(data);
        }
        });
        
    });
    $('#download-excel').on('click',function(){
        var html_table_data = "";  
                var bRowStarted = true;  
                $('#advanced_table tbody>tr').each(function () {  
                    $('td', this).each(function () {  
                        if (html_table_data.length == 0 || bRowStarted == true) {  
                            html_table_data += $(this).text();  
                            bRowStarted = false;  
                        }  
                        else  
                            html_table_data += " | " + $(this).text();  
                    });  
                    html_table_data += "\n";  
                    bRowStarted = true;  
                });          console.log(html_table_data);
        $.ajax({
        type: 'POST',
        data: {data:html_table_data},
        url: "{{guard_url('invoice/download_excel')}}",
        success: function (data) {
            // $('#pagination-list').html(data);
        }
        });
        
    });
</script>
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

.select2-container .select2-selection--multiple .select2-selection_arrow,
.select2-container .select2-selection--single .select2-selectionarrow,
.select2-container--default .select2-selection--multiple .select2-selectionarrow,
.select2-container--default .select2-selection--single .select2-selection_arrow {
    top: 8px;
}

.select2-container {
    text-align: left;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    margin-right: 5px;
    top: 8px;
}
#seller_id {
    width: 200px !important;
}
.centered {
  margin: auto;
  width: 50%;
  
}
</style>