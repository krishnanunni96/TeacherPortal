<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Order Report</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Start Date</label>
                            <input type="date" class="form-control" wire:model="date1">
                        </div>
                        <div class="col-md-4">
                            <label>End Date</label>
                            <input type="date" class="form-control" wire:model="date2">
                        </div>
                        <div class="col-md-4">
                            <label>Status</label>
                            <select class="form-select" wire:model="status_filter">
                                <option class="select-box" value="">All Orders</option>
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
                        <table class="table table-bordered align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Date</th>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Order ID</th>
                                    <th style="width: 30%" class="text-uppercase text-secondary text-xs  opacity-7">Customer</th>
                                    <th style="width: 20%" class="text-uppercase text-secondary text-xs  opacity-7">Order Amount</th>
                                    <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="table-responsive mb-4 table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered align-items-center mb-0 ">
                            <tbody>
                                @foreach ($orders as $item)
                                <tr>
                                    <td style="width: 15%" >
                                        <p class="text-xs px-3 mb-0">{{dateHelper($item->date_of_order)}}</p>
                                    </td>
                                    <td style="width: 15%" >
                                        <p class="text-xs px-3 mb-0">
                                            <span class="font-weight-bold">{{$item->order_no}}</span>
                                        </p>
                                    </td>
                                    <td style="width: 30%" >
                                        <p class="text-xs px-3 font-weight-bold mb-0">{{$item->customer->name}}</p>
                                    </td>
                                    <td style="width: 21.3%" >
                                        <p class="text-xs px-3 font-weight-bold mb-0">${{$item->order_amount}}</p>
                                        @php
                                            $total_order_amount+=$item->order_amount;
                                        @endphp
                                    </td>
                                    <td style="width: 20%" >
                                        <a type="button" class="badge badge-sm bg-{{statusColor($item->status)}} text-uppercase">{{getOrderStatus($item->status)}}</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row align-items-center px-4 mb-3">
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total Orders:</span>
                            <span class="text-sm text-dark ms-2 fw-600 mb-0">{{$orders->count()}}</span>
                        </div>
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total Order Amount:</span>
                            <span class="text-sm text-dark ms-2 fw-600 mb-0">${{$total_order_amount}}</span>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-success me-2 mb-0" wire:click="downloadPDF">Download Report</button>
                            <a type="button" href="{{url('print/orders/'.$this->date1.'/'.$this->date2.'/'.$this->status_filter)}}" target="_blank" class="btn btn-warning mb-0">Print Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       
</div>
