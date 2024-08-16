<div>

<div class="row align-items-center justify-content-between mb-4">
    <div class="col">
        <h5 class="fw-500 text-white">Add Order</h5>
    </div>
    <div class="col-auto">
        <a href="{{url('order')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
            <i class="fa fa-arrow-left me-2"></i> Back
        </a>
    </div>
</div>
<div class="row match-height">
    <div class="col-lg-7 col-12">
        <div class="card mb-4">
            <div class="card-header p-4">
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Search Here" wire:model="service_search">
                    </div>
                </div>
            </div>
            <div class="pos-card-wrapper-scroll-y my-custom-scrollbar-pos-card  mb-3">
                <div class="row align-items-center g-3 px-4 ">
                    @forelse ($services as $data)
                        <div class="col-lg-3 col-6 text-center">
                            <div class="border-dashed border-1 border-secondary border-radius-md py-1">
                                <a type="button" wire:click.prevent="serviceType({{$data->id}})" data-bs-toggle="modal" data-bs-target="#servicetype">
                                    <div class="avatar avatar-xl mb-3">
                                        @if ($data->icon=='Baby Cloths')
                                            <img src="{{asset('assets/img/service-icons/baby-clothes.png')}}" class="rounded p-2">
                                        @elseif($data->icon=='Female')
                                            <img src="{{asset('assets/img/service-icons/woman-clothes.png')}}" class="rounded p-2">
                                        @elseif($data->icon=='Other')
                                            <img src="{{asset('assets/img/service-icons/full-suit.png')}}" class="rounded p-2">
                                        @endif
                                    </div>
                                    <p class="text-xs font-weight-bold">{{$data->name}}</p>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-dismissible" role="alert">
                            <span class="text-danger">query returned zero results.</span> 
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-12">
        <div class="card mb-4">
            <div class="card-header p-4">
                <div class="row">
                    <div class="col-md-9 mb-3">
                        <input type="text" class="form-control" placeholder="@if($customer) {{$customer->name}} @else Select a Customer @endif" wire:model="customer_search">
                        @error('customer_search') <span class="text-danger">{{$message}}</span> @enderror
                            @if ($customer_search)
                            <ul class="list-group position-fixed" style="width: 21.25%; z-index:9;">
                                @forelse ($customer_search_results as $value)
                                    <a href="#" class="list-group-item list-group-item-action" wire:click.prevent="customerSelect({{$value->id}})">{{$value->name}}</a>
                                @empty
                                    <div class="alert">
                                        <span class="list-group-item list-group-item-action text-danger">query returned zero results.</span> 
                                    </div>
                                @endforelse
                            </ul>
                            @endif
                    </div>
                    <div class="col-md-3 mb-3">
                        <button type="button" class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addcustomer">
                            <i class="fa fa-plus me-2"></i> Add
                        </button>
                    </div>
                    <div class="col-md-6">
                        <input type="text" wire:model="order_number" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <input type="date" wire:model="date_of_order" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-items-center mb-3">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-5">Service</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7">Rate</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7">QTY</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="order-list-wrapper-scroll-y my-custom-scrollbar-order-list">
                    <div class="row align-items-center g-3 px-4 ">
                        @foreach ($cart as $key => $value)
                            <div class="col-lg-12 col-12">
                                <div class="row ms-2 align-items-center">
                                    <div class="col-4">
                                        <h6 class="text-xs h6 mb-0">{{$value['service_name']}}</h6>
                                        <span class="text-xxs fw-600 text-primary">[{{$value['type_name']}}]</span>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" class="form-control form-control-sm text-center" wire:model="rate.{{$key}}">
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group align-items-center">
                                            <div class="badge bg-secondary text-xxs text-center p-66" type="button" wire:click="quantitySub({{$key}})"><i class="@if($quantity[$key]==1) fa fa-trash @else fa fa-minus @endif"></i></div>
                                            <input type="number" class="form-control form-control-sm text-center @error('quantity.'.$key) is-invalid @enderror" wire:model="quantity.{{$key}}">
                                            <div class="badge bg-primary text-xxs text-center p-66" type="button" wire:click="quantityAdd({{$key}})"><i class="fa fa-plus"></i></div>
                                            {{-- @error('quantity.'.$key) <span class="invalid-feedback">{{ $message }}</span> @enderror --}}
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <a type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Select Image" data-container="body" data-animation="true"><span class=" fw-600 text-primary"><i class="fa fa-file-image-o"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr>
            <div class="row align-items-center px-4 mb-3">
                <div wire:poll class="col">
                    <p class="text-sm mb-0 fw-500">Gross Total</p>
                    <p class="text-sm text-success fw-600 mb-0">₹{{$gross_total}}</p>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger me-2 mb-0" wire:click="resetFn">Clear All</button>
                    <button type="submit" wire:click.prevent="grossTotal" class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#payment">Save & Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade " id="servicetype" tabindex="-1" role="dialog" aria-labelledby="servicetype" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600">Select Service Type</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-2 align-items-center">
                        @if ($service_types )
                            @foreach ($service_types as $item)
                                <div class="col-md-12 mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" wire:model="service_type_id" value="{{$item->id}}" id="{{$item->id}}" name="service_type_id">
                                        <label class="form-check-label" for="{{$item->id}}">{{$item->type_name}}</label>
                                        @php
                                            $service_ID=$item->service_id;
                                        @endphp
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>                                                      
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" wire:click.prevent="servicesAdd({{$service_ID}})" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade " id="addcustomer" tabindex="-1" role="dialog" aria-labelledby="addcustomer" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600">Add Customer</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control" placeholder="Enter Customer Name">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="number" wire:model="mobile" class="form-control" placeholder="Enter Phone Number">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Email ID</label>
                            <input type="text" wire:model="email" class="form-control" placeholder="Enter Email ID">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Tax Number</label>
                            <input type="text" wire:model="tax_number" class="form-control" placeholder="Enter Tax Number">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address</label>
                            <textarea type="text" wire:model="address" class="form-control" placeholder="Enter Customer Address"></textarea>
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="employee" wire:model="is_active" checked>
                                <label class="form-check-label" for="employee">Is Active ?</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="customerAdd">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="payment" aria-hidden="true">
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
                        @foreach ($order_addons as $item)
                            <div class=" col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="addon.{{$item->id}}" value="{{$item->addon_price}}" id="{{$item->id}}">
                                    <label class="custom-control-label" for="{{$item->id}}">{{$item->addon_name}}</label>
                                </div>
                            </div>
                        @endforeach
                        <div class=" col-12">
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Delivery Date</label>
                                    <input type="date" wire:model="date_of_delivery" class="form-control @error('date_of_delivery') is-invalid @enderror">
                                    @error('date_of_delivery') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Discount</label>
                                    <input type="number" wire:model="discount" class="form-control @error('discount') is-invalid @enderror" placeholder="Enter Amount">
                                    @error('discount') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-50 align-items-center">
                                <div class="col text-sm fw-500">Sub Total:</div>
                                <div class="col-auto  text-sm fw-500">${{$gross_total}}</div>
                            </div>
                            <div class="row mb-50 align-items-center">
                                <div class="col text-sm fw-500">Addon:</div>
                                <div class="col-auto text-sm fw-500">+&nbsp;${{$addon_sum}}</div>
                            </div>
                            <div class="row mb-50 align-items-center">
                                <div class="col text-sm fw-500">Discount:</div>
                                <div class="col-auto  text-sm fw-500">-&nbsp;${{$discount}}</div>
                            </div>
                            <div class="row mb-50 align-items-center">
                                <div class="col text-sm fw-500">Tax (15%):</div>
                                <div class="col-auto text-sm fw-500">+&nbsp;${{$taxamnt}}</div>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col text-sm fw-600">Gross Total:</div>
                                <div class="col-auto text-sm fw-600">${{$gross_total_2}}</div>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Paid Amount</label>
                                    <input type="number" onwheel="return false;" wire:model="paid_amount" class="form-control @error('paid_amount') is-invalid @enderror" placeholder="Enter Amount">
                                    @error('paid_amount') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Payment Type</label>
                                    <select class="form-select" wire:model="payment_type">
                                        <option value="1" class="select-box">CASH</option>
                                        <option value="2" class="select-box">UPI</option>
                                        <option value="3" class="select-box">CARD</option>
                                        <option value="4" class="select-box">CHEQUE</option>
                                        <option value="5" class="select-box">BANK TRANSFER</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col text-sm fw-600">Balance:</div>
                                <div class="col-auto text-sm fw-600">${{$balance}}</div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <label class="form-label">Notes/Remarks</label>
                                <textarea class="form-control" wire:model="remark" placeholder="Enter Notes"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    @if ($payment_type==1 || $payment_type==4)
                        <button type="submit" wire:click.prevent="saveAndPrint" class="btn btn-primary">Pay&nbsp;${{$paid_amount}}</button>
                    @else
                        <button type="submit" wire:click.prevent="saveWithRazorpay" class="btn btn-warning">Pay using Razorpay</button>
                    @endif
                </div>
            </form>
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
                "image": "https://www.xfortech.com/images/logo.png",
                "order-id": data.order_id,
                "handler": function(response) {
                    if (typeof response.razorpay_payment_id == 'undefined' || response.razorpay_payment_id < 1) {
                        Livewire.emit('failedTransaction');
                    } else {
                        var data=response.razorpay_payment_id;
                        Livewire.emit('successTransaction',data);
                    }
                },
                "prefill":{
                    "contact":data.phone,
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