
                                @if(user()->buyerorders->count()>0)
                                <div class="row layout-wrap " >


                                @foreach(user()->buyerorders()->paginate(3)  as $order)
                                    @foreach($order->orderproducts as $data)
                                   <div class="col-12 list-item list-item-thumb">
                                        <div class="card d-flex flex-row mb-3">

                                            <a class="d-flex card-img"  href="{{guard_url('order/order?id='.@$data->getRoutekey())}}">
                                                <img src="{{$data->products!=null?trans_url(@$data->products->defaultImage('images','sm')):''}}" alt="Donec sit amet est at sem iaculis aliquam." class="list-thumbnail responsive border-0 element"  >
                                            </a>



                                            <div class="d-flex flex-grow-1 min-width-zero card-content">
                                                <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                                    <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="#">{{@$data->products->name}}</a>
                                                    <p class="mb-1 text-muted text-small category w-15 w-xs-100">{{@$data->products->category->name}}</p>
                                                    <p class="mb-1 text-muted text-small category w-15 w-xs-100">{{@$order->first()->created_at!=null?$order->first()->created_at->diffForHumans():''}}</p>
                                                    <p class="mb-1 text-muted text-small date w-15 w-xs-100">${{number_format(@$data->products->price,2)}}</p>
                                                    <div class="w-25 w-xs-100 text-md-right">
                                                        <span class="badge badge-danger">{{@$order->status}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    @endforeach
                                   @endforeach

                       @else
                     <p>No orders yet.</p>
                        @endif
                        </div>
