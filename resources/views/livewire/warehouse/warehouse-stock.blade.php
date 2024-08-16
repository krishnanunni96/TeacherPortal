<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Warehouse Stock Entries</h5>
        </div>
        <div class="col-auto">
            <a href="{{url('warehouse/stock/add')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
                <i class="fa fa-plus me-2"></i> Add New Entry
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
                            <select class="form-select" wire:model="dropdown_search">
                                <option class="select-box" value="">All Entries</option>
                                <option class="select-box" value="1">Staff 1</option>
                                <option class="select-box" value="2">Staff 2</option>
                                <option class="select-box" value="3">Staff 3</option>
                                <option class="select-box" value="4">Staff 4</option>
                                <option class="select-box" value="5">Staff 5</option>
                                <option class="select-box" value="6">Staff 6</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Date</th>
                                    <th class="text-uppercase text-secondary text-xs  opacity-7">Staff</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Order ID</th>
                                    <th class="text-uppercase text-secondary text-xs  opacity-7">QTY</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stocks as $data)
                                    <tr>
                                        <td>
                                            <p class="text-sm px-3 mb-0">{{dateHelper($data->date)}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm px-3 font-weight-bold mb-0">{{$data->staff->name}}</p>
                                            <p class="text-sm px-3 mb-0">ID:&nbsp;{{$data->staff_id}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm px-3 mb-0">
                                                <span class="font-weight-bold">{{$data->order_id}}</span>
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm px-3 font-weight-bold mb-0">{{$data->total_qty}}</p>
                                        </td>
                                        <td>
                                            <a href="{{url('warehouse/stock/preview/'.$data->id)}}" type="button" class="badge badge-xs badge-primary text-xs fw-600">
                                                View
                                            </a>
                                            <a href="{{url('warehouse/stock/edit/'.$data->id)}}" type="button" class="badge badge-xs badge-warning text-xs fw-600">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert">
                                        <span class="text-danger">query returned zero result..</span>
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
                                    <div class="col-auto text-sm fw-500">Customer Name</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Order ID:</div>
                                    <div class="col-auto text-sm fw-500">ORD - 10001</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Order Date:</div>
                                    <div class="col-auto  text-sm fw-500">16/01/2022</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Delivery Date:</div>
                                    <div class="col-auto  text-sm fw-500">16/01/2022</div>
                                </div>
                                <hr>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Order Amount:</div>
                                    <div class="col-auto  text-sm fw-500">$132900.00</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">Paid Amount:</div>
                                    <div class="col-auto text-sm fw-500">$100.00</div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col text-sm fw-600">Balance:</div>
                                    <div class="col-auto text-sm fw-600">$1500000.00</div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-md-6 mb-1">
                                        <label class="form-label">Paid Amount</label>
                                        <input type="number" class="form-control" placeholder="Enter Amount">
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label class="form-label">Payment Type</label>
                                        <select class="form-select" required>
                                            <option class="select-box">CASH</option>
                                            <option class="select-box">UPI</option>
                                            <option class="select-box">CARD</option>
                                            <option class="select-box">CHEQUE</option>
                                            <option class="select-box">BANK TRANSFER</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <label class="form-label">Notes/Remarks</label>
                                    <textarea class="form-control" placeholder="Enter Notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
