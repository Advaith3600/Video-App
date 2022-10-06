<div class="app-list-wrap-inner">
@foreach($data as $key => $value) 
       <div class="app-item " data-id="task_1" data-action='SHOW' data-load-to="#app-entry"
        data-url="{{guard_url('subscribe/subscribe')}}/{{$value['id']}}">

        <div class="app-avatar">
            <input type="checkbox" name="tasks_list" id="task_1">
            @if(is_array(@$value['productimage']))
        <img src="{{trans_url('/image/xs/'.current(@$value['productimage'])['path'])}}" alt="{{@$value['name'][0]}}" class="app-project-name bg-secondary"></img>
        @else
        <label class="app-project-name bg-secondary" for="task_{{$value['id']}}">{{@$value['product_name'][0]}}</label>

        @endif
        </div>
            <div class="app-info" data-action='EDIT' id="entry{{$value['id']}}" data-load-to="#app-entry"
                        data-url="{{guard_url('subscribe/subscribe')}}/{{@$value['id']}}/edit/">
                <h3>{{@$value['company_name']}}</h3>
                <div class="app-metas mt-5">
                <p>{{@$value['seller_name']}}</p>
                @if(@$value['status'])
                    <span class="badge badge-status bg-success"> <h3>{{@$value['status']}}</h3></span>
                 @endif   
                </div>
            </div>
             
      </div>
@endforeach
                          
                            
</div>
