{!! Theme::partial('header') !!}


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="{{theme_asset('css/select2.min.css')}}" />
<script type="text/javascript" src="{{theme_asset('js/select2.min.js')}}"></script>


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
.wrap.select2-selection--multiple { height: 100% }
.select2-container .wrap.select2-selection--multiple .select2-selection__rendered li { word-wrap: break-word; text-overflow: inherit; white-space: normal !important }
</style>
<!-- <link rel="stylesheet" href="{{theme_asset('packages/css/tempusdominus-bootstrap-4.min.css')}}" /> -->
<div class="app-content-wrap bg-white">
    <div class="app-list-wrap">
        <div class="app-list-inner">
            <div class="app-list-header d-flex align-items-center justify-content-between">
                <h3>Manage Orders</h3>
                <span class="" id="show-data"><i class="las la-search"></i></span>
            </div>
            <div class="app-list-toolbar show-div"  style="display:none">
                <form>
                    <div class="header-search app-entry-form-section">
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

                            <br>
                            <div class="row">
                                <div class="col-md-12 pre-div">
                                {!! Form::select('order_code')
                                -> options(Order::supplier_order()->toArray())
                                -> style('width: 100%;font-weight: bold;')
                                -> addClass('searchable-dropdown  ')
                                -> label('')
                                -> placeholder(trans('order::order.placeholder.order_code'))!!}
                                </div>
                            </div>
                        
                        <br>
                       
                            <div class="row">
                                <div class="col-md-12 pre-div">
                                {!! Form::select('user_id')
                                -> options(User::getbuyers()->toArray())
                                -> addClass('searchable-dropdown ')
                                -> label('')
                                -> style('width: 100%')
                                -> placeholder(trans('buyer::buyer.placeholder.name'))!!}
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <select class="form-control select2 pre-div " name="status" id="status" style="width: 100%;font-weight: bold;">
                                        <option value="">Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Dispatched">Dispatched</option>
                                        <option value="Completed">Completed</option>

                                    </select>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-danger" type="reset" id="reset-btn">Clear Filter</button>
                            <button type="button" class="btn btn-theme " id="app-search" style="float: right;"><i
                                    class="las la-search"></i></button>
                        </div>
                    </div>
                </form>
                
            </div>
           
           
            <div class="app-items" id="item-list">
            
                @include('order::default.order.more', ['mode' => 'list'])
            </div>
        </div>
        <div class="app-detail-wrap" id="app-entry">


        </div>

    </div>

</div>
<script type="">
     $(document).ready( function(){
      
        $('.daterange').daterangepicker({
            locale: {
            format: 'DD/MM/YYYY'
        }  
 
        });
        $(".drp-buttons").on('click','.cancelBtn', function () {
            $('.daterange').val('');
        });

        $('.daterange').val('');

    if("{{array_key_exists('id',request()->all())}}"!=false)
        $("#app-entry").load("{{guard_url('order/order/'.request()->id).'/edit'}}");

    });

  if("{{array_key_exists('id',request()->all())}}"==false)
    var module_link = "{{guard_url('order/order')}}";
    var current_page = {{$meta['pagination']['current_page']}};
    var total_pages = {{$meta['pagination']['total_pages']}};
    $(function () {
        // $("#app-search").on('search', function () { console.log($(this).val().replace(/\s/g, '%20'));
        //      app.load('#item-list', module_link + '?q=' + $(this).val().replace(/\s/g, '%20'));
        // });
        $("#app-search").on('click', function () {
            var created_at = $('#created_at').val();
            var start_date ="";
            var end_date ="";
            if(created_at){
                var date = created_at.split('-');
                start_date = date[0].trim();
                end_date = date[1].trim();
            }
           
            var order_code =$('#order_code').val();
            var user_id=$('#user_id').val();
            var status=$('#status').val();
            app.load('#item-list', module_link + '?start_date=' + start_date + '&&end_date=' + end_date + '&&order_id='+ order_code +'&&status='+ status +'&&user_id=' +user_id);
            $(".show-div").hide("slow");
        });
        $("span.search-btn").on('click', function () { 
            app.load('#item-list', module_link );
        });
    });
    $("#reset-btn").click(function () {
        $("#order_code").select2({
            placeholder: "Please enter order code",
        });
        $("#user_id").select2({
            placeholder: "Please enter name",
        });
        $("#order_code,#buyer").select2("val", 'All');
    });
  
    $(document).ready(
    function(){
        $("#show-data").click(function () {
            $(".show-div").toggle("slow");
        });

    });

</script>
<style>

</style>