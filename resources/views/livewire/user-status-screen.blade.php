<div>

    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Customer Status Screen</h5>
        </div>
        {{-- <div class="col-auto">
            <a href="{{url('customer/add')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
                <i class="fa fa-plus me-2"></i> Add New Customer
            </a>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="scrum-board-container">
                    <div class="flex">
                        <div class="scrum-board pending">
                            <h5 class="text-uppercase text-secondary">Inactive</h5>
                            <div class="scrum-board-column"  id="inactive">
                                @foreach ($inactive as $key=>$item)
                                <div class="{{isActive($item->is_active)}} overflow" id="{{$item->id}}" >
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <span class="fw-600 ms-2 text-sm text-dark">{{$item->name}}</span>
                                            <div class="ms-2 mb-0">
                                                <span class="text-xs fw-600 ms-2">{{$item->mobile}}</span>
                                            </div>
                                        </div>
                                        <div><span class="fw-600 text-dark text-sm me-2">{{$item->email}}</span></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
    
                        <div class="scrum-board ready">
                            <h5 class="text-uppercase text-success">Active</h5>
                            <div class="scrum-board-column" id="active">
                                @foreach ($active as $key=>$item)
                                <div class="{{isActive($item->is_active)}} overflow" id="{{$item->id}}">
                                    <div class="d-flex justify-content-between mb-2">
                                            <div>
                                                <span class="fw-600 ms-2 text-sm text-dark">{{$item->name}}</span>
                                                <div class="ms-2 mb-0">
                                                    <span class="text-xs fw-600 ms-2">{{$item->mobile}}</span>
                                                </div>
                                            </div>
                                            <div><span class="fw-600 text-dark text-sm me-2">{{$item->email}}</span></div>
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
        var drake = dragula([document.querySelector('#inactive'), document.querySelector('#active')]);

        drake.on("drop", function(el,target, source, sibliing){
            console.log(el.id, target.id);
            @this.isActiveFn(el.id, target.id);
        });    
    
    </script>
    @endpush
</div>
