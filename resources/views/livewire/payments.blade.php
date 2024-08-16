<div>

    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Payments</h5>
        </div>
        <div class="col-auto">
            {{-- <a href="{{url('order/add')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
                <i class="fa fa-plus me-2"></i> Add New Order
            </a> --}}
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
                                    <th class="text-uppercase text-secondary text-xs opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Customer</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Order Amount</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Amount Paid</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Balance</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                        @php
                                            $order_amount=0;
                                            $total_paid=0;
                                            $balance=0;
                                                foreach($orders as $value){
                                                    if($value->customer_id==$customer->id){
                                                        $order_amount += $value->order_amount;
                                                    }
                                                }
                                                foreach($payments as $data){
                                                    if($data->customer_id==$customer->id){
                                                        // $order_amount += $data->order_amount;
                                                        $total_paid += $data->paid_amount;
                                                    }
                                                    $balance=$order_amount-$total_paid;
                                                }
                                        @endphp
                                    @if($order_amount !=0)
                                    <tr>
                                        <td>
                                            <p class="text-sm px-3 mb-0">{{$loop->index+1}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm px-3 font-weight-bold mb-0">{{$customer->name}}</p>
                                            <p class="text-sm px-3 mb-0">+91{{$customer->mobile}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm px-3 font-weight-bold mb-0">${{$order_amount}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm px-3 font-weight-bold mb-0">${{$total_paid}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm px-3 font-weight-bold mb-0">${{$balance}}</p>
                                        </td>
                                        <td>
                                            @if ($balance>0)
                                            <a href="{{url('payments/add/'.$customer->id)}}" type="button" class="badge badge-xs badge-success text-xs fw-600">
                                                Add Payment
                                            </a>
                                            @else
                                            <a class="badge disabled badge-xs badge-light text-xs fw-600">
                                                Fully Paid
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    {{-- <div wire:ignore.self class="modal fade " id="addpayment" tabindex="-1" role="dialog" aria-labelledby="addpayment" aria-hidden="true">
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
                                @foreach ($order as $item)
                                @if($loop->index==0)
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Customer Name:</div>
                                    <div class="col-auto text-sm fw-500">{{$item->customer->name}}</div>
                                </div>
                                <hr>
                                @endif
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Order ID:</div>
                                    <div class="col-auto text-sm fw-500">{{$item->order_no}}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Order Date:</div>
                                    <div class="col-auto  text-sm fw-500">{{dateHelper($item->date_of_order)}}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Delivery Date:</div>
                                    <div class="col-auto  text-sm fw-500">{{dateHelper($item->date_of_delivery)}}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Order Amount:</div>
                                    <div class="col-auto  text-sm fw-500">${{$item->order_amount}}</div>
                                </div>
                                <hr>
                                @endforeach
                                @php
                                    $amount_sum=$order_amount=$balance=0;
                                    foreach ($payments as $data){
                                            $amount_sum += $data->paid_amount;
                                            $order_amount+= $data->order->order_amount;
                                        }
                                        $bal = $order_amount - $amount_sum;
                                @endphp
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Paid Amount:</div>
                                    <div class="col-auto text-sm fw-500">${{$amount_sum}}</div>
                                </div>

                                <hr>
                                <div class="row align-items-center">
                                    <div class="col text-sm fw-600">Balance:</div>
                                    <div class="col-auto text-sm fw-600">${{$bal}}</div>
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
    </div> --}}
    
    </div>