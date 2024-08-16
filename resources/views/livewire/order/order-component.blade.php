<div>

<div class="row align-items-center justify-content-between mb-4">
    <div class="col">
        <h5 class="fw-500 text-white">Orders</h5>
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
            <div class="card-header p-4">
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Search Here" wire:model="search">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" wire:model="status">
                            <option class="select-box" value="" selected>All Orders</option>
                            <option class="select-box" value="1">Pending</option>
                            <option class="select-box" value="2">Processing</option>
                            <option class="select-box" value="3">Ready to Deliver</option>
                            <option class="select-box" value="4">Delivered</option>
                            <option class="select-box" value="5">Returned</option>
                            <option class="select-box" value="6">Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xs opacity-7">Order Info</th>
                                <th class="text-uppercase text-secondary text-xs  opacity-7">Customer</th>
                                <th class="text-uppercase text-secondary text-xs  opacity-7">Order Amount</th>
                                <th class="text-center text-uppercase text-secondary text-xs opacity-7">Status</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7">Payment</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $item)
                            <tr>
                                <td>
                                    <p class="text-sm px-3 mb-0">
                                        <span class="me-2">Order ID:</span>
                                        <span class="font-weight-bold">{{$item->order_no}}</span>
                                    </p>
                                    <p class="text-sm px-3 mb-0">
                                        <span class="me-2">Order Date:</span>
                                        <span class="font-weight-bold">{{dateHelper($item->date_of_order)}}</span>
                                    </p>
                                    <p class="text-sm px-3 mb-0">
                                        <span class="me-2">Delivery Date:</span>
                                        <span class="font-weight-bold">{{dateHelper($item->date_of_delivery)}}</span>
                                    </p>
                                </td>
                                <td>
                                    <p class="text-sm px-3 font-weight-bold mb-0">{{$item->customer->name}}</p>
                                    <p class="text-sm px-3 mb-0">+91{{$item->customer->mobile}}</p>
                                </td>
                                <td>
                                    <p class="text-sm px-3 font-weight-bold mb-0">${{$item->order_amount}}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <a type="button" class="badge badge-sm bg-{{statusColor($item->status)}} text-uppercase">{{getOrderStatus($item->status)}}</a>
                                </td>
                                <td class="px-3">
                                    <p class="text-sm mb-0">
                                        <span class="me-2">Total Amount:</span>
                                        <span class="font-weight-bold">${{$item->order_amount}}</span>
                                    </p>
                                    <p class="text-sm mb-1">
                                        <span class="me-2">Paid Amount:</span>
                                        <span class="font-weight-bold">${{$item->paid_amount}}</span>
                                    </p>
                                    @php
                                        $bal=$this->paymentStatus($item->id);
                                    @endphp
                                    @if ($bal>0)
                                    <a wire:click.prevent="addPayment({{$item->id}})" data-bs-toggle="modal" data-bs-target="#addpayment" type="button" class="badge badge-xs badge-success text-xs fw-600">
                                        Add Payment
                                    </a>
                                    @else
                                    <a class="badge disabled badge-xs badge-light text-xs fw-600">
                                        Fully Paid
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('order/preview/'.$item->id)}}" type="button" class="badge badge-xs badge-primary text-xs fw-600">
                                        View    
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <div class="alert alert-dismissible">
                                    <span class="text-danger">query returned zero results..</span>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade " id="addpayment" tabindex="-1" role="dialog" aria-labelledby="addpayment" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600">Payment Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-2 align-items-center">
                        @if($order)
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
                                    <input type="number" onwheel="return false;" class="form-control @error('amount_paid') is-invalid @enderror" placeholder="Enter Amount" wire:model="amount_paid">
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
                            <hr>
                            <div class="col-12">
                                <label class="form-label">Notes/Remarks</label>
                                <textarea class="form-control" placeholder="Enter Notes"></textarea>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>