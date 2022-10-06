{!! Theme::partial('header') !!}

<div class="app-content-wrap bg-white">
    <div class="app-list-wrap">
        <div class="app-list-inner">
            <div class="header-search ">
                <div class="app-list-header d-flex align-items-center justify-content-between">
                <h3>Manage Paid/ Unpaid Orders</h3>
                <span class="search-btn" id="show-data" style="display: none"><i class="las la-search"></i></span>
                </div>
            </div>
            <div class="app-list-toolbar ">
            
            
                            <div class="col-md-12 text-center">
                                <label> Status</label>
                                <select class="form-control " name="payment_status" id="payment_status">
                                  
                                    <option value="Pending">Unpaid</option>
                                    <option value="Paid">Paid</option>

                                </select>
                            </div>
                        
            </div>

            <div class="app-items" data-url="{{guard_url('invoice/invoice')}}" id="item-list">
            
                @include('order::buyer.invoice.more', ['mode' => 'list'])
            </div>
        </div>

        <div class="app-detail-wrap" id="app-entry">

        </div>

    </div>

</div>

<script type="">
    $(document).ready( function(){
        $( "#payment_status" ).change(function()   {
            
            $(".app-entry-form-wrap").html('');
            $("span.search-btn").click();
        });
        
    });

    var module_link = "{{guard_url('invoice/invoice')}}";
    var current_page = {{$meta['pagination']['current_page']}};
    var total_pages = {{$meta['pagination']['total_pages']}};
    $(function () {
       
        $("span.search-btn").on('click', function () {
            
            var payment_status=$('#payment_status').val();
            app.load('#item-list', module_link + '?payment_status=' + payment_status);
        });
    });
    if("{{array_key_exists('id',request()->all())}}"!=false)
    $("#app-entry").load("{{guard_url('invoice/invoice/'.request()->id)}}");
    
    
</script>