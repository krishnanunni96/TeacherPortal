<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Purchase Details</h5>
        </div>
        <div class="col-auto">
            <a href="{{url('warehouse/purchase')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
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
                            <h6 class="text-uppercase fw-500">{{$purchase->supplier->name}}</h6>
                            <p class="text-sm mb-0">+91 {{$purchase->supplier->mobile}}</p>
                            <p class="text-sm mb-3">{{$purchase->supplier->address}}</p>
                            <p class="text-sm mb-0 text-uppercase">TAX: {{$purchase->supplier->tax_number}}</p>
                        </div>
                        <div class="col-auto">
                            <h6 class="fw-500">
                                <span class="text-sm">Purchase #:</span>
                                <span class="fw-600 ms-2">{{$purchase->purchase_no}}</span>
                            </h6>
                            <p class="text-sm mb-1">
                                <span>Date:</span>
                                <span class="fw-600 ms-2">{{dateHelper($purchase->purchase_date)}}</span>
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
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Rate</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">QTY</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Tax %</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Tax Amount</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $data)
                                <tr>
                                    <td>
                                        <h6 class="mb-1 text-sm px-3">{{$data->product_name}}</h6>
                                    </td>
                                    <td class="">
                                        <p class="text-sm px-3 mb-0">${{$data->rate}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm px-3 mb-0">{{$data->quantity}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm px-3 mb-0">{{$data->tax_percentage}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm px-3 mb-0">{{$data->tax_amount}}</p>
                                    </td>
                                    <td class="">
                                        <p class="text-sm px-3 mb-0">${{$data->total}}</p>
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
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm">Sub Total:</div>
                                    <div class="col-auto text-sm">${{$purchase->sub_total}}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm">Service Charge:</div>
                                    <div class="col-auto text-sm">+${{$purchase->service_charge}}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm">Discount:</div>
                                    <div class="col-auto text-sm">-&nbsp;${{$purchase->discount}}</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col text-sm">Tax Total:</div>
                                    <div class="col-auto text-sm">+${{$purchase->tax_total}}</div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col text-sm fw-600">Gross Total:</div>
                                    <div class="col-auto text-sm text-dark fw-600">${{$purchase->gross_total}}</div>
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
