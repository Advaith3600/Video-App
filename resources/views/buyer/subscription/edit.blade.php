<style>
.error{
  border: 1px solid red;
}

</style>
<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="las la-box app-sec-title-icon"></i>
        <h2>Recurring Order Description</h2>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 d-none d-md-block">
           
                <form class="app-entry-form pl-0 pr-0" action="" id="subForm">
                    @php
                    $subscribe_status = trans('order::order.options.status');
                    $subscribe_key = array_search($subscribe->status,$subscribe_status);
                    @endphp
                    
                    
                   
                    
                    <div class="app-entry-form-section" id="order">
                        <div class="section-title"></div>
                         
                       
                         <div class="modal-body">
                            <input type="hidden" name="delivery_type" value="{{$subscribe->delivery_type}}" >                                    </td>
                            <input type="hidden" id="sub_id" name="sub_id" value="{{$subscribe->id}}" >                                    </td>
                        <div class="row">
                            <div class="form-group col-md-4 ">
                                <h6>Company name: </h6><label for="task_title">{{@$subscribe->seller->company_name}}</label>
                                
                            </div>
                            <div class="form-group col-md-4 ">
                                <h6>Next Delivery: </h6><label for="task_title">{{$subscribe->taskSchuduled!=null?date('j F, Y', strtotime(@$subscribe->taskSchuduled->scheduled_on)):'' }}</label>
                                
                            </div>
                            <div class="form-group col-md-4 ">
                                <h6>ABN: </h6><label for="task_title">{{@$subscribe->seller->abn}}</label>
                            </div>
                            @if(@$subscribed_product->product->images!=null)
                            <div class="form-group col-md-12 ">
                                <h6>Image: </h6>
                                <img src="{{trans_url('/image/md/'.current(@$subscribed_product->product->images)['path'])}}" style="max-height:300px;"></img>
                            </div>
                            @endif
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th  width="8%"> </th>
                                    <th >Products</th>
                                    <th width="15%" >Quantity</th>
                                    <th>Delivery Type</th>
                                    <th>Recurrence Interval</th>
                                    <th>Recurrence Date</th>
                                    
                                </tr>  
                            </thead>
                            <tbody>
                            @foreach(@$subscribe->subscriptionProducts as $key => $value) 
                          
                                <tr>
                                  <td>  <input type="checkbox" disabled class="check_subscription rm-disabled"{{'checked'}} value="{{$value->id}}" name="check_subscription[{{$value->id}}]" >
                                    <input type="hidden" name="seller_id" value="{{$subscribe->seller_id}}" > </td>                                  
                                    <td>{!! @$value->product->name !!}
                                        
                                    </td>
                                    <td><input type="number" class="form-control  quantity rm-disabled" disabled name="quantity[{{$value->id}}]" value="{{$value->quantity}}" style="width:70px;" min="1"></td>
                                    <td>{{@$subscribe->deliveryType->name}}</td>
                                    <td><select disabled   name="repeat_interval" class="form-control intervelselect rm-disabled" id="repeat_interval">
                            <option value="1-W" {{($subscribe->repeat_interval=='1-W'?'selected' :'')}}> 1 week</option>
                            <option value="2-W" {{($subscribe->repeat_interval=='2-W'?'selected' :'')}}> 2 week</option>
                            <option value="1-M" {{($subscribe->repeat_interval=='1-M'?'selected' :'')}}> 1 month</option>
                            <option value="2-M" {{($subscribe->repeat_interval=='2-M'?'selected' :'')}}> 2 months</option>
                            <option value="3-M" {{($subscribe->repeat_interval=='3-M'?'selected' :'')}}> 3 months</option>
                            <option value="6-M" {{($subscribe->repeat_interval=='6-M'?'selected' :'')}}> 6 months</option>
                            <option value="1-Y" {{($subscribe->repeat_interval=='1-Y'?'selected' :'')}}> 1 year</option>
                        </select></td>
                        <td>{{$subscribe->taskSchuduled!=null?date('j F, Y', strtotime(@$subscribe->taskSchuduled->scheduled_on)):'' }} </td>
                                </tr>  
                            @endforeach

                            </tbody>
                        </table>     
                </div>
                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary skip_sub" data-id="@$subscribe->id">Skip Recurrence</button>

                    <button type="button" class="btn btn-secondary cancel_sub" data-id="@$subscribe->id">Cancel Recurring Order </button>
                    <button type="button" id="edit_subscription" name="save_subscription" class="btn btn-secondary">Edit</button>
                    <button type="button" id="update_subscription" name="save_subscription" class="btn btn-secondary hidden">Update</button>

                
                </div>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>

<div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-md modal-dialog-centered modal-dialog-scrollable" >
        <div class="modal-content">
          <form name="form_subscrption" id="form_subscrption">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accountModalLabel">Skip Subscrption</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <div class="form-group col-md-5 ">
                        <label for="task_title "><b>Select  intervel</b></label>
                        <select   name="skip_interval" id="skip_interval" class="form-control" id="repeat_interval">
                            <option value="7" {{($subscribe->repeat_interval=='1-W'?'selected' :'')}}> 1 week</option>
                            <option value="14" {{($subscribe->repeat_interval=='2-W'?'selected' :'')}}> 2 week</option>
                            <option value="30" {{($subscribe->repeat_interval=='1-M'?'selected' :'')}}> 1 month</option>
                            <option value="60" {{($subscribe->repeat_interval=='2-M'?'selected' :'')}}> 2 months</option>
                            <option value="90" {{($subscribe->repeat_interval=='3-M'?'selected' :'')}}> 3 months</option>
                            <option value="180" {{($subscribe->repeat_interval=='6-M'?'selected' :'')}}> 6 months</option>
                            <option value="360" {{($subscribe->repeat_interval=='1-Y'?'selected' :'')}}> 1 year</option>
                        </select>
                    </div>
                     
              
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="skip_subscription" name="save_subscription" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var get_route_key = "{{$subscribe->getRouteKey()}}";
    $('.received').on('input',function(){
        $quantity = $(this).attr('quantity');
        $received = $(this).val();
        if($quantity < $received){
            toastr.warning('Given number is invalid');
            $(this).addClass('error');
        }else{
            $(this).removeClass('error');
            $('#pending_'+$(this).attr('id')).val($quantity - $received);

        }
    });
    
    $('#edit_subscription').on('click',function(){
        $('.rm-disabled').prop('disabled', false);
        $(this).addClass('hidden');
        $('#update_subscription').removeClass('hidden');
        $('#update_subscription').show();
       
    });
    $('#update_subscription').on('click',function(){
        $('.rm-disabled').prop('disabled', false);
        
       
        $.ajax({
            type: 'GET',
            url: "{{guard_url('subscribe/update-subscription')}}",
            data:$('#subForm').serialize(),
            success: function () {
                //toastr.success('Subscription Updated');
                
                $('#edit_subscription').removeClass('hidden');
                $('#edit_subscription').show();
                $('.rm-disabled').prop('disabled', true);
                $('#update_subscription').addClass('hidden');
               
                
            }
            });
    });
   
    $('.skip_sub').click(function(){
        $('#subscribeModal').modal('show');
         $('#skip_subscription').click(function(){
             var interval=$('#skip_interval').val();
             var sub_id=sub_id=$('#sub_id').val();
        $.ajax({
            type: 'GET',
            url: "{{guard_url('subscribe/skip-subscription')}}",
            data:{interval:interval,sub_id:sub_id},
            success: function () {
                toastr.success('Subscription date changed');
                $('#subscribeModal').modal('toggle');
                $("#app-entry").load('subscribe/'+get_route_key+'/edit');
                
            }
            });
            });
    
    });

    $('.cancel_sub').click(function(){

        $.ajax({
            type: 'GET',
            url: "{{guard_url('subscribe/cancel-subscription')}}",
            data:$('#subForm').serialize(),
            success: function () {
                toastr.success('Subscription Removed');
                location.reload();
                
            }
            });
    });

 $(".intervelselect").on('change', function(e) {
        elm = $(this);
        let interval = elm.val();
        let sub_id=$('#sub_id').val();
        

        return new Promise((resolve) => {
            swal({
                    title: "Are you sure?",
                text: "You will not be able to recover this data!",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: "Ok"
                },
            }).then((willDelete) => {
                if (willDelete) {
                  
                    $.ajax({
                        url: "{{guard_url('subscribe/change-subscription-intervel')}}",
                        type: "GET",
                         data:{interval:interval,sub_id:sub_id},
                        success: function(result) {
                            if(result.interval!=''){
                               
                                    $(".intervelselect").val(result.interval);
                                    //$(".intervelselect").val(result.interval).change();
                                    toastr.success('Delivery Intervel Updated');
                           
                            }
                           // elm.closest('.list-prodcut').remove();
                       

                        },
                        error: function() {
                            swal({
                                title: 'Opps...',
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    })
                }
            });
        });

    });
    
</script>