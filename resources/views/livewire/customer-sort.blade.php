<div>

    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Customer Sort</h5>
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
                            <h5 class="text-uppercase text-secondary">Sorted Order</h5>
                            <div class="container">
                                <div class="row" id="sort">
                                    @foreach ($customers as $key => $item)
                                        <div class="col-4" id="{{ $item->id }}">
                                            <div class="scrum-task-ready overflow" >
                                                <div class="d-flex justify-content-between mb-2">
                                                    <div>
                                                        <span
                                                            class="fw-600 ms-2 text-sm text-dark">{{ $item->name }}</span>
                                                        <div class="ms-2 mb-0">
                                                            <span class="text-xs fw-600 ms-2">{{ $item->mobile }}</span>
                                                        </div>
                                                    </div>
                                                    <div><span
                                                            class="fw-600 text-dark text-sm me-2">{{ $item->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            {{-- <div class="scrum-board pending">
                            <h5 class="text-uppercase text-secondary">Delete Customer</h5>
                            <div class="scrum-board-column col-4"  id="delete">
                            </div>
                        </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="{{ asset('assets/dragula/dragula.min.js') }}"></script>
            <script>
                "use strict";
                var drake = dragula([document.querySelector('#sort')]);
                drake.on("drop", function(el, target, source, sibliing) {
                    const children = Array.from(target.children);
                    const ids = children.map(element => {
                        return element.id;
                    });
                    @this.set('sort', ids);
                    // @this.delete(el.id, target.id);
                });
            </script>
        @endpush

    </div>
