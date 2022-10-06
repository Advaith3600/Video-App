<div class="app-list-wrap-inner">
<div class="app-list-toolbar">
<div class="app-list-pagination">
                        <button type="button" class="btn select-all-btn"><i class="fas fa-check"></i></button>
                        <span class="mr-5" id="paginate-number">Page {{$meta['pagination']['current_page']}} of {{ $meta['pagination']['total_pages'] }}</span>
                        <a href="#" id="page-previous"><i class="las la-angle-left"></i></a>
                        <a href="#" id="page-next"><i class="las la-angle-right"></i></a>
                    </div>
            </div>
@foreach($data as $key => $value)
                            
       <div class="app-item " data-id="task_1" data-action='SHOW' data-load-to="#app-entry"
        data-url="{{guard_url('order/order')}}/{{$value['id']}}">

            <div class="app-avatar"  >
                <input type="checkbox" name="tasks_list" >
                <label class="app-project-name bg-secondary" for="task_{{$value['id']}}">{{@$value['f_name'][0]}}</label>
            </div>
            <div class="app-info" data-action='EDIT' id="entry{{$value['id']}}" data-load-to="#app-entry"
                        data-url="{{guard_url('order/order')}}/{{$value['id']}}/edit">
                <h3>{{@$value['order_code']}}</h3>
                <div class="app-metas mt-5">
                <p>{{@$value['created_at']}}</p>
                @if(@$value['status'])
                    <span class="badge badge-status bg-success"> <h3>{{@$value['status']}}</h3></span>
                 @endif   
                </div>
            </div>
             
      </div>
@endforeach
                          
                            
</div>

<script type="">
   
    var module_link = "{{guard_url('order/order')}}";
    var current_page = {{$meta['pagination']['current_page']}};
    var total_pages = {{$meta['pagination']['total_pages']}};
    $('#page-previous').click(function () {
       
       current_page--;
       if (current_page < 1) {
           current_page = 1
       }
       $('#paginate-number').text('Page ' + current_page + ' of ' + total_pages);
       var created_at = $('#created_at').val();
            var start_date ="";
            var end_date ="";
            if(created_at){
                var date = created_at.split('-');
                start_date = date[0].trim();
                end_date = date[1].trim();
            }
           
            var order_code =$('#order_code').val();
            var user_id=$('#buyer').val();
            var status=$('#status').val();

       app.load('#item-list', module_link + '?page=' + current_page + '&&start_date=' + start_date + '&&end_date=' + end_date + '&&order_id='+ order_code +'&&status='+ status +'&&user_id=' +user_id);
   });
   $('#page-next').click(function () {
        current_page++;
        if (current_page > total_pages) {
            current_page = total_pages
        }

        var created_at = $('#created_at').val();
            var start_date ="";
            var end_date ="";
            if(created_at){
                var date = created_at.split('-');
                start_date = date[0].trim();
                end_date = date[1].trim();
            }
           
            var order_code =$('#order_code').val();
            var user_id=$('#buyer').val();
            var status=$('#status').val();
        $('#paginate-number').text('Page ' + current_page + ' of ' + total_pages);
         app.load('#item-list', module_link + '?page=' + current_page + '&&start_date=' + start_date + '&&end_date=' + end_date + '&&order_id='+ order_code +'&&status='+ status +'&&user_id=' +user_id);
  
    });
    
</script>
