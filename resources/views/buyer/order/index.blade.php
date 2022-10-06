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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="app-content-wrap bg-white">
    <div class="app-list-wrap">
        <div class="app-list-inner">
            <div class="header-search ">
                <div class="app-list-header d-flex align-items-center justify-content-between">
                <h3>Manage Orders</h3>
                <a class="btn add-app-btn btn-icon btn-outline " href="{{guard_url('subscribe/subscribe')}}"><i
                            data-toggle="tooltip" data-placement="right" title="Recurring Orders"  class="las la-cog"></i></a>
                 <span class="" id="show-data"><i class="las la-search"></i></span>
                </div>
               
            </div>
            <div class="app-list-toolbar show-div" style="display:none">
            <form>
                <div class="header-search">
                    <div class="col-md-12">
                            <div class="row ">
                                <div class="col-md-12 pre-div ">
                                    <div class="input-group ">
                                        <input type="text" class="form-control daterange pre-div"  id="created_at" name="created_at"
                                        placeholder="Date Range">
                                        <div class="input-group-append drp-buttons">
                                                <button type="button" id="clear_date" class="cancelBtn"title="Clear">X</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </br>
                        <div class="row">
                            <div class="col-md-12 pre-div">
                                {!! Form::select('order_code')
                                -> options(Order::getorders()->toArray())
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
                                -> options(User::getvendors()->toArray())
                                -> addClass('searchable-dropdown')
                                -> label('')
                                -> placeholder(trans('buyer::buyer.placeholder.name'))!!}
                            </div>
                        </div></br>
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control select2 pre-div " name="status" id="status" style="width:100%">
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
            </form>

            </div>
            

            <div class="app-items" data-url="{{guard_url('order/order')}}" id="item-list">
                @include('order::buyer.order.more', ['mode' => 'list'])
            </div>
        </div>

        <div class="app-detail-wrap" id="app-entry">

        </div>

    </div>

</div>
<script>
// $( "#status" ).change(function()   {

//     $statusID = $(this).val();

//         $.ajax({
//             type : 'get',
//             url: "{{guard_url('order-filter')}}",
//             data : {statusID :  $statusID}

//         }).done(function(response) {
//         });
//     });

</script>
<script type="">
    $(document).ready( function(){
        $('.searchable-dropdown').css('width','100%');
        $('.daterange').daterangepicker({
            locale: {
            format: 'DD/MM/YYYY'
        }  

        });
        $(".drp-buttons").on('click','.cancelBtn', function () {
            $('.daterange').val('');
        });

        $("#show-data").click(function () {
            $(".show-div").toggle("slow");
        });
        $('.daterange').val('');

    });

    if("{{array_key_exists('id',request()->all())}}" == false)
        var module_link = "{{guard_url('order/order')}}";
    var current_page = {{$meta['pagination']['current_page']}};
    var total_pages = {{$meta['pagination']['total_pages']}};
    $(function () {
        

        $("#app-search").on('click', function () {
        var created_at = $('#created_at').datepicker('option', {dateFormat: 'dd/mm/yy'}).val();
        var start_date ="";
        var end_date ="";
        if(created_at){
            var date = created_at.split('-');
            start_date = date[0].trim();
            end_date = date[1].trim();
        }
            var order_code=$('#order_code').val();
            var user_id=$('#buyer').val();
            var status=$('#status').val();
            app.load('#item-list', module_link + '?start_date=' + start_date + '&&end_date=' + end_date + '&&order_id='+ order_code +'&&status='+ status +'&&user_id=' +user_id);
            $(".show-div").hide("slow");
        });
        
    });
    
    $("#reset-btn").click(function () {
        $("#order_code").select2({
            placeholder: "Please enter order code",
        });
        $("#buyer").select2({
            placeholder: "Please enter name",
        });
        $("#order_code,#buyer").select2("val", 'All');
    });
    $(document).ready( function(){
        if("{{array_key_exists('id',request()->all())}}"!=false){
            $("#app-entry").load("{{guard_url('order/order/'.request()->id)}}");
        }
    });

    
</script>
<style>
</style>