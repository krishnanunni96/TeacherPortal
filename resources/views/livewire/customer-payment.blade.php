<div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body p-0">
                    <div class="row g-2 align-items-center">
                            <div class="col-12 px-5 py-5">
                                @foreach ($order as $item)
                                @if($loop->index==0)
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Customer Name:</div>
                                    <div class="col-auto text-sm fw-500">{{$item->customer->name}}</div>
                                    @php
                                        $cust_name = $item->customer->name;
                                        $cust_email = $item->customer->email;
                                        $cust_mobile = $item->customer->mobile;
                                    @endphp
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

                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Paid Amount:</div>
                                    <div class="col-auto text-sm fw-500">${{$amount_sum}}</div>
                                </div>

                                <hr>
                                <div class="row align-items-center">
                                    <div class="col text-sm fw-600">Balance:</div>
                                    <div class="col-auto text-sm fw-600">${{$balance}}</div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-md-6 mb-1">
                                        <label class="form-label">Paid Amount</label>
                                        <input type="number" onwheel="return false;" id="paid_amount" class="form-control @error('paid_amount') is-invalid @enderror" placeholder="Enter Amount" wire:model="paid_amount">
                                        @error('paid_amount') <span class="invalid-feedback">{{$message}}</span> @enderror
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
                    <div class="card-footer">
                        <a type="button" href="{{url('payments')}}" class="btn btn-secondary">Back</a>
                        @if($payment_type==1 || $payment_type==4)
                            <button type="submit" class="btn btn-primary" wire:click.prevent="save">Pay&nbsp;${{$paid_amount}}</button>
                        @else
                            <button type="submit" class="btn btn-warning" wire:click.prevent="saveWithRazorpay">Pay using Razorpay</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
            Livewire.on('razorpay', (data) => {               
                var amount=data.amount;
                var options = {                         
                    "key": "rzp_test_xjceuPFLRiKHcW",               
                    "amount":(amount*100),
                    "currency": "INR",
                    "name": "Laundry Box",
                    "description": "Payment Towards Laundry Box",
                    "color":"#ffaaa5",
                    "image": "{{asset('assets/img/logo-ct.png')}}",
                    "handler": function(response) {
                        if (typeof response.razorpay_payment_id == 'undefined' || response.razorpay_payment_id < 1) {
                            Livewire.emit('failedTransaction');
                        } else {
                        console.log(response.razorpay_payment_id);
                            var data=response.razorpay_payment_id;
                            Livewire.emit('successTransaction',data);
                        }
                    },
                    "prefill":{
                        "contact":data.mobile,
                        "email":data.email,
                    },
                    "theme":{
                        "color":"#0596f0",
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            });
        });
    </script>
    @endpush

</div>