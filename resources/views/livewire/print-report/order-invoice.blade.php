<div>

    <div class="row">
        <div class="col-lg-9">
            {{-- <div class="card mb-4">
                <div class="card-header p-4"> --}}
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="text-uppercase fw-500">Store Name</h5>
                            <p class="text-sm mb-0">+91 9876543210</p>
                            <p class="text-sm mb-0">store@store.com</p>
                            <p class="text-sm mb-3">Xfortech, Mannaniya Complex, Kollam- 691001</p>
                            <p class="text-sm mb-0 text-uppercase">TAX: 32ahsohad57819101</p>
                        </div>
                        <div class="col-auto mt-4">
                            <h6 class="text-uppercase fw-500">
                                <span>Order ID:</span>
                                <span class="ms-2 fw-600">#{{$order->order_no}}</span>
                            </h6>
                            <p class="text-sm mb-1">
                                <span>Order Date:</span>
                                <span class="fw-600 ms-2">{{dateHelper($order->date_of_order)}}</span>
                            </p>
                            <p class="text-sm mb-3">
                                <span>Delivery Date:</span>
                                <span class="fw-600 ms-2">{{dateHelper($order->date_of_delivery)}}</span>
                            </p>
                            <div class="d-flex align-items-center">
                                <div><span class="text-sm">Order Status:</span></div>
                                    <span class="fw-500 ms-2">{{getOrderStatus($order->status)}}</span>
                            </div>
                        </div>
                    </div>
                {{-- </div>
                <div class="card-body p-0"> --}}
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" style="border: 1px solid #dddddd;">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Service Name</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Images</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Rate</th>
                                    <th class="text-center text-uppercase text-secondary text-xs  opacity-7">QTY</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_details as $item)
                                <tr>
                                    <td>
                                        <p class="text-sm px-3 mb-0">{{$loop->index+1}}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div>   
                                                @if($item->service->icon=="Baby Cloths")
                                                <img src="{{asset('assets/img/service-icons/baby-clothes.png')}}" class="avatar avatar-sm me-3">
                                                @elseif($item->service->icon=="Female")
                                                <img src="{{asset('assets/img/service-icons/woman-clothes.png')}}" class="avatar avatar-sm me-3">
                                                @elseif($item->service->icon=="Full Suit")
                                                <img src="{{asset('assets/img/service-icons/full-suit.png')}}" class="avatar avatar-sm me-3">
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-1 text-sm">{{$item->service->name}}</h6>
                                                <span class="text-xs fw-600 text-primary">[{{$item->service_type_2->type_name}}]</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <a type="button" class="avatar rounded-circle" data-bs-toggle="modal" data-bs-target="#image">
                                                <img alt="Image placeholder" src="{{asset('assets/img/team-4.jpg')}}" class="rounded-circle h-100">
                                            </a>
                                            <a type="button" class="avatar rounded-circle" data-bs-toggle="modal" data-bs-target="#image">
                                                <img alt="Image placeholder" src="{{asset('assets/img/test.jpg')}}" class="rounded-circle h-100">
                                            </a>
                                        </div>
                                    </td>
                                    <td class="">
                                        <p class="text-sm px-3 mb-0">${{$item->rate}}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-sm px-3 mb-0">{{$item->quantity}}</p>
                                    </td>
                                    <td class="">
                                        <p class="text-sm px-3 mb-0">${{$item->rate*$item->quantity}}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                {{-- </div> --}}
                <hr class="mb-0 mt-0 bg-secondary">
                {{-- <div class="card-footer px-4"> --}}
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <h6 class="mb-2 fw-500">Invoice To:</h6>
                            <h6 class="mb-1 fw-500 text-sm">{{$customer_details->name}}</h6>
                            <p class="text-sm mb-0">+91 {{$customer_details->mobile}}</p>
                            <p class="text-sm mb-0">{{$customer_details->email}}</p>
                            <p class="text-sm mb-3">{{$customer_details->address}}</p>
                            <p class="text-sm mb-0">VAT: {{$customer_details->tax_number}}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h6 class="fw-500 mb-2">Payment Details:</h6>
                            <div class="">
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm">Sub Total:</div>
                                    <div class="col-auto text-sm">${{$order->sub_total}}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm">Addon:</div>
                                    <div class="col-auto text-sm">${{$addon_sum}}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm">Discount:</div>
                                    <div class="col-auto text-sm">${{$order->discount}}</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col text-sm">Tax (15%):</div>
                                    <div class="col-auto text-sm">${{$order->tax_amount}}</div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col text-sm fw-600">Gross Total:</div>
                                    <div class="col-auto text-sm text-dark fw-600">${{$gross_total}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div>
            </div> --}}
        </div>
    </div>

</div>
