<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Stock Entry Details</h5>
        </div>
        <div class="col-auto">
            <a href="{{url('warehouse/stock')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
                <i class="fa fa-arrow-left me-2"></i> Back
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header p-4">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-uppercase fw-500">{{$stock->staff->name}}</h6>
                            <p class="text-sm mb-0">ID:&nbsp;{{$stock->staff_id}}</p>
                        </div>
                        <div class="col-auto">
                            <h6 class="fw-500">
                                <span class="text-sm">Order ID:</span>
                                <span class="fw-600 ms-2">{{$stock->order_id}}</span>
                            </h6>
                            <p class="text-sm mb-1">
                                <span>Date:</span>
                                <span class="fw-600 ms-2">{{dateHelper($stock->date)}}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Product</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">QTY</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                <tr>
                                    <td>
                                        <h6 class="mb-1 text-sm px-3">{{$item->name}}</h6>
                                    </td>
                                    <td>
                                        <p class="text-sm px-3 mb-0">
                                            <span>{{$item->quantity}}</span>
                                            <span>NOS</span>
                                        </p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="mb-0 mt-0 bg-secondary">
                <div class="card-footer px-4">
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <div class="">
                                <div class="row align-items-center">
                                    <div class="col text-sm fw-600">Total QTY:</div>
                                    <div class="col-auto text-sm text-dark fw-600">{{$stock->total_qty}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 position-relative text-center">
                            <p class="text-sm fw-500 mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                Powered by <a href="https://www.xfortech.com" class="text-primary fw-600" target="_blank">Xfortech</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
