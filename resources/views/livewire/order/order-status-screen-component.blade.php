<div>

    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Order Status Screen</h5>
        </div>
        <div class="col-auto">
            <a href="{{url('order/add')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
                <i class="fa fa-plus me-2"></i> Add New Order
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="scrum-board-container">
                    <div class="flex">
                        <div class="scrum-board pending">
                            <h5 class="text-uppercase text-secondary">Pending</h5>
                            <div class="scrum-board-column"  id="pending">
                                @foreach ($pending as $key=>$item)
                                <div class="{{status($item->status)}} overflow" id="{{$item->id}}" >
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <span class="fw-600 ms-2 text-sm text-dark">{{$item->customer->name}}</span>
                                            <div class="ms-2 mb-0">
                                                <span class="text-xs">Delivery Date:</span>
                                                <span class="text-xs fw-600 ms-2">{{dateHelper($item->date_of_delivery)}}</span>
                                            </div>
                                        </div>
                                        <div><span class="fw-600 text-dark text-sm me-2">{{$item->order_no}}</span></div>
                                    </div>
                                    <div class="pt-1 mb-0">
                                        @foreach ($service1 as $value)
                                            @if($value->service->icon=="Baby Cloths")
                                            <img src="{{asset('assets/img/service-icons/baby-clothes.png')}}" class="avatar avatar-sm ms-2 p-1 bg-light">
                                            @elseif($value->service->icon=="Female")
                                            <img src="{{asset('assets/img/service-icons/woman-clothes.png')}}" class="avatar avatar-sm ms-2 p-1 bg-light">
                                            @elseif($value->service->icon=="Full Suit")
                                            <img src="{{asset('assets/img/service-icons/full-suit.png')}}" class="avatar avatar-sm ms-2 p-1 bg-light">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
    
                        <div class="scrum-board-processing processing">
                            <h5 class="text-uppercase text-warning">Processing</h5>
                            <div class="scrum-board-column"  id="processing">
                                @foreach ($processing as $key=>$item)
                                <div class="{{status($item->status)}} overflow"  id="{{$item->id}}" >
                                        <div class="d-flex justify-content-between mb-2">
                                            <div>
                                                <span class="fw-600 ms-2 text-sm text-dark">{{$item->customer->name}}</span>
                                                <div class="ms-2 mb-0">
                                                    <span class="text-xs">Delivery Date:</span>
                                                    <span class="text-xs fw-600 ms-2">{{dateHelper($item->date_of_delivery)}}</span>
                                                </div>
                                            </div>
                                            <div><span class="fw-600 text-dark text-sm me-2">{{$item->order_no}}</span></div>
                                        </div>
                                        <div class="pt-1 mb-0">
                                            @foreach ($service2 as $value)  
                                                @if($value->service->icon=="Baby Cloths")
                                                <img src="{{asset('assets/img/service-icons/baby-clothes.png')}}" class="avatar avatar-sm ms-2 p-1 bg-light">
                                                @elseif($value->service->icon=="Female")
                                                <img src="{{asset('assets/img/service-icons/woman-clothes.png')}}" class="avatar avatar-sm ms-2 p-1 bg-light">
                                                @elseif($value->service->icon=="Full Suit")
                                                <img src="{{asset('assets/img/service-icons/full-suit.png')}}" class="avatar avatar-sm ms-2 p-1 bg-light">
                                                @endif
                                            @endforeach
                                        </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
    
                        <div class="scrum-board ready">
                            <h5 class="text-uppercase text-success">Ready to Deliver</h5>
                            <div class="scrum-board-column" id="ready">
                                @foreach ($ready_to_deliver as $key=>$item)
                                <div class="{{status($item->status)}} overflow" id="{{$item->id}}">
                                    <div class="d-flex justify-content-between mb-2">
                                            <div>
                                                <span class="fw-600 ms-2 text-sm text-dark">{{$item->customer->name}}</span>
                                                <div class="ms-2 mb-0">
                                                    <span class="text-xs">Delivery Date:</span>
                                                    <span class="text-xs fw-600 ms-2">{{dateHelper($item->date_of_delivery)}}</span>
                                                </div>
                                            </div>
                                            <div><span class="fw-600 text-dark text-sm me-2">{{$item->order_no}}</span></div>
                                        </div>
                                        <div class="pt-1 mb-0">
                                            @foreach ($service3 as $value)
                                                @if($value->service->icon=="Baby Cloths")
                                                <img src="{{asset('assets/img/service-icons/baby-clothes.png')}}" class="avatar avatar-sm ms-2 p-1 bg-light">
                                                @elseif($value->service->icon=="Female")
                                                <img src="{{asset('assets/img/service-icons/woman-clothes.png')}}" class="avatar avatar-sm ms-2 p-1 bg-light">
                                                @elseif($value->service->icon=="Full Suit")
                                                <img src="{{asset('assets/img/service-icons/full-suit.png')}}" class="avatar avatar-sm ms-2 p-1 bg-light">
                                                @endif
                                            @endforeach
                                        </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
<script src="{{ asset('assets/dragula/dragula.min.js') }}"></script>

    <script>
        "use strict";
        var drake = dragula([document.querySelector('#pending'), document.querySelector('#processing'), document.querySelector('#ready')]);

        drake.on("drop", function(el,target, source, sibliing){
            @this.statusChange(el.id, target.id); 
        });    
    
    </script>
    @endpush
</div>
