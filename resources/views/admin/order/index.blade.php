<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-file-text-o"></i> {!! trans('order::order.name') !!} <small> {!! trans('app.manage') !!} {!! trans('order::order.names') !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! guard_url('/') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
            <li class="active">{!! trans('order::order.names') !!}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div id='order-order-entry'>
    </div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                    <li class="{!!(request('status') == '')?'active':'';!!}"><a href="{!!guard_url('order/order')!!}">{!! trans('order::order.names') !!}</a></li>
                    <li class="{!!(request('status') == 'archive')?'active':'';!!}"><a href="{!!guard_url('order/order?status=archive')!!}">Archived</a></li>
                    <li class="{!!(request('status') == 'deleted')?'active':'';!!}"><a href="{!!guard_url('order/order?status=deleted')!!}">Trashed</a></li>
                    <li class="pull-right">
                    <span class="actions">
                    <form id="frm_filter" action="{{guard_url('order/filter')}}"> 
                    
                    <label for="delivery-date">Filter by Order date</label>
                    <input type="text" name="order-date" id="order-date"/>
                    <button type="button" class="btn btn-primary" id="filter_btn">Filter</button>
                
                </form>   
                    <a class="btn btn-xs btn-purple" id="download_csv" type="button" >
                        <i aria-hidden="true" class="fa fa-download">
                        </i>
                        <span class="hidden-sm hidden-xs">
                        Download CSV
                        </span>
                    </a>
              
                    @include('order::admin.order.partial.filter')
                    @include('order::admin.order.partial.column')
                    </span> 
                </li>
            </ul>
            <div class="tab-content">
                <table id="order-order-list" class="table table-striped data-table">
                    <thead class="list_head">
                        <th style="text-align: right;" width="1%"><a class="btn-reset-filter" href="#Reset" style="display:none; color:#fff;"><i class="fa fa-filter"></i></a> <input type="checkbox" id="order-order-check-all"></th>
                        <th data-field="f_name">{!! trans('order::order.label.user')!!}</th>
                    <!--<th data-field="l_name">{!! trans('order::order.label.email')!!}</th>-->
                    <th data-field="l_name">{!! trans('address::address.label.name')!!}</th>
                    <!--<th data-field="l_name">{!! trans('address::address.label.phone')!!}</th>-->
                    <!--<th data-field="l_name">{!! trans('address::address.label.address_line1')!!}</th>-->
                    <!--<th data-field="l_name">{!! trans('address::address.label.address_line2')!!}</th>-->
                    <th data-field="total">{!! trans('order::order.label.total')!!}</th>
                    <th data-field="payment_mode">{!! trans('order::order.label.payment_mode')!!}</th>
                    <th data-field="payment_status">{!! trans('order::order.label.payment_status')!!}</th>
                    <th data-field="status">{!! trans('order::order.label.status')!!}</th>
                     <th data-field="created_at">{!! 'Date' !!}</th> 
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

var oTable;
var oSearch;
$(document).ready(function(){
    app.load('#order-order-entry', '{!!guard_url('order/order/0')!!}');
    oTable = $('#order-order-list').dataTable( {
        'columnDefs': [{
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'className': 'dt-body-center',
            'render': function (data, type, full, meta){
                return '<input type="checkbox" name="id[]" value="' + data.id + '">';
            }
        }], 
        
        "responsive" : true,
        "order": [[1, 'asc']],
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! guard_url('order/order') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $.each(oSearch, function(key, val){
                aoData.push( { 'name' : key, 'value' : val } );
            });
            app.dataTable(aoData);
            $.ajax({
                'dataType'  : 'json',
                'data'      : aoData,
                'type'      : 'GET',
                'url'       : sSource,
                'success'   : fnCallback
            });
        },

        "columns": [
            {data :'id'},
            {data :'user_id'},
            // {data :'email'},
            {data :'address_id'},
            // {data :'phone'},
            // {data : 'address_line1'},
            // {data : 'address_line2'},
            {data :'total'},
            {data :'payment_mode'},
            {data :'payment_status'},
            {data :'status'},
            {data :'created_at'},
        ],
        "pageLength": 25
    });

    $('#order-order-list tbody').on( 'click', 'tr', function () {
        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        var d = $('#order-order-list').DataTable().row( this ).data();
        $('#order-order-entry').load('{!!guard_url('order/order')!!}' + '/' + d.id);
    });

    $('#order-order-list tbody').on( 'change', "input[name^='id[]']", function (e) {
        e.preventDefault();

        aIds = [];
        $(".child").remove();
        $(this).parent().parent().removeClass('parent'); 
        $("input[name^='id[]']:checked").each(function(){
            aIds.push($(this).val());
        });
    });

    $("#order-order-check-all").on( 'change', function (e) {
        e.preventDefault();
        aIds = [];
        if ($(this).prop('checked')) {
            $("input[name^='id[]']").each(function(){
                $(this).prop('checked',true);
                aIds.push($(this).val());
            });

            return;
        }else{
            $("input[name^='id[]']").prop('checked',false);
        }
        
    });


    $(".reset_filter").click(function (e) {
        e.preventDefault();
        $("#form-search")[ 0 ].reset();
        $('#form-search input,#form-search select').each( function () {
          oTable.search( this.value ).draw();
        });
        $('#order-order-list .reset_filter').css('display', 'none');

    });


    // Add event listener for opening and closing details
    $('#order-order-list tbody').on('click', 'td.details-control', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

});
</script>