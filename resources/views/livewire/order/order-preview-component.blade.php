<div>

<div class="row align-items-center justify-content-between mb-4">
    <div class="col">
        <h5 class="fw-500 text-white">Order Details</h5>
    </div>
    <div class="col-auto">
        <a href="{{url('order')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
            <i class="fa fa-arrow-left me-2"></i> Back
        </a>
    </div>
</div>
<div class="row">
    <div class="col-lg-9">
        <div class="card mb-4">
            <div class="card-header p-4">
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
                            <div class="dropdown ms-2">
                                <button class="btn btn-xs bg-{{statusColor($order->status)}} dropdown-toggle mb-0 text-white" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{getOrderStatus($order->status)}}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" wire:click="status(2)">Processing</a></li>
                                    <li><a class="dropdown-item" href="#" wire:click="status(3)">Ready to Delivery</a></li>
                                    <li><a class="dropdown-item" href="#" wire:click="status(4)">Delivered</a></li>
                                    <li><a class="dropdown-item" href="#" wire:click="status(5)">Returned</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
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
            </div>
            <hr class="mb-0 mt-0 bg-secondary">
            <div class="card-footer px-4">
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
                    <hr class="bg-secondary">
                    <div class="col-md-1">
                        <h6 class="mb-2 text-sm fw-500">Notes:</h6>
                    </div>
                    <div class="col-md-11">
                        <p class="text-sm mb-0">{{$order->remark}}</p>
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
    <div class="col-lg-3">
        <div class="card mb-4">
            <div class="card-body p-4">
                <h6 class="mb-3 fw-500 mt-2">Service Addons</h6>
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                            @foreach ($service_addon as $data)
                                <span class="mb-3 text-sm">
                                    <span class="fw-500">{{$data->addon->addon_name}}:</span>
                                    <span class="text-sm ms-2">${{$data->addon->addon_price}}</span>
                                </span>
                            @endforeach
                        </div>
                    </li>
                </ul>
                <h6 class="mb-3 fw-500 mt-2">Payments</h6>
                <div class="timeline timeline-one-side">
                    @foreach ($payments as $data)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fa fa-dot-circle-o text-secondary"></i>
                            </span>
                            <div wire:poll class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">${{$data->paid_amount}}</h6>
                                <p class="text-secondary text-xs mt-1 mb-0">
                                    <span>{{dateHelper2($data->created_at)}}</span>
                                    <span class="ms-2 fw-600 text-uppercase">[{{getPaymentMode($data->payment_type)}}]</span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    @if ($balance>0)
                        <div class="col-12">
                            <a data-bs-toggle="modal" data-bs-target="#addpayment" type="button" class="badge badge-success mb-3 w-100 py-3 fw-600">
                                Add Payment
                            </a>
                        </div>
                    @elseif ($balance==0)
                        <div class="col-12">
                            <a type="button" class="badge badge-light disabled mb-3 w-100 py-3 fw-600">
                                Fully Paid
                            </a>
                        </div>
                    @endif
                    <div class="col-12">
                        <a type="button" href="{{url('print/order/invoice/'.$order->id)}}" target="_blank" class="btn btn-icon btn-warning mb-0 w-100" >Print Invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="image" tabindex="-1" role="dialog" aria-labelledby="image" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600" id="image">Image</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-12">
                        <img src="{{asset('assets/img/team-4.jpg')}}" class="img-fluid h-100">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade " id="addpayment" tabindex="-1" role="dialog" aria-labelledby="addpayment" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600" id="addpayment">Payment Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-2 align-items-center">
                        <div class=" col-12">
                            <div class="row mb-50 align-items-center">
                                <div class="col text-sm fw-500">Customer Name:</div>
                                <div class="col-auto text-sm fw-500">{{$order->customer->name}}</div>
                            </div>
                            <div class="row mb-50 align-items-center">
                                <div class="col text-sm fw-500">Order ID:</div>
                                <div class="col-auto text-sm fw-500">{{$order->order_no}}</div>
                            </div>
                            <div class="row mb-50 align-items-center">
                                <div class="col text-sm fw-500">Order Date:</div>
                                <div class="col-auto  text-sm fw-500">{{dateHelper($order->date_of_order)}}</div>
                            </div>
                            <div class="row mb-50 align-items-center">
                                <div class="col text-sm fw-500">Delivery Date:</div>
                                <div class="col-auto  text-sm fw-500">{{dateHelper($order->date_of_delivery)}}</div>
                            </div>
                            <hr>
                            <div class="row mb-50 align-items-center">
                                <div class="col text-sm fw-500">Order Amount:</div>
                                <div class="col-auto  text-sm fw-500">${{$order->order_amount}}</div>
                            </div>
                            @foreach ($payments as $data)
                            <div class="row mb-50 align-items-center">
                                <div class="col text-sm fw-500">Paid Amount:</div>
                                <div class="col-auto text-sm fw-500">${{$data->paid_amount}}</div>
                            </div>
                            @endforeach
                            <hr>
                            <div class="row align-items-center">
                                <div class="col text-sm fw-600">Balance:</div>
                                <div class="col-auto text-sm fw-600">${{$balance}}</div>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Paid Amount</label>
                                    <input type="number" onwheel="return false" step=".01" class="form-control @error('amount_paid') is-invalid @enderror" placeholder="Enter Amount" wire:model="amount_paid">
                                    @error('amount_paid') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Payment Type</label>
                                    <select class="form-select" wire:model="payment_type">
                                        <option class="select-box" value="1">CASH</option>
                                        <option class="select-box" value="2">UPI</option>
                                        <option class="select-box" value="3">CARD</option>
                                        <option class="select-box" value="4">CHEQUE</option>
                                        <option class="select-box" value="5">BANK TRANSFER</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="addPayment">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>