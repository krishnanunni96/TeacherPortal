<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Sales Report</h5>
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
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 10%" class="text-uppercase text-secondary text-xs opacity-7">Date</th>
                                    <th style="width: 10%" class="text-uppercase text-secondary text-xs opacity-7">Invoice #</th>
                                    <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Customer</th>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Sub Total</th>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Discount</th>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Tax Amount</th>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Gross Total</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="table-responsive mb-4 table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered align-items-center mb-0 ">
                            <tbody>
                                @foreach ($orders as $item)
                                <tr>
                                    <td style="width: 10%" >
                                        <p class="text-xs px-3  mb-0">{{dateHelper($item->date_of_order)}}</p>
                                    </td>
                                    <td style="width: 10%" >
                                        <p class="text-xs px-3 mb-0">
                                            <span class="font-weight-bold">{{$item->order_no}}</span>
                                        </p>
                                    </td>
                                    <td style="width: 20%" >
                                        <p class="text-xs px-3 font-weight-bold mb-0">{{$item->customer->name}}</p>
                                    </td>
                                    <td style="width: 15%" >
                                        <p class="text-xs px-3 font-weight-bold mb-0">${{$item->sub_total}}</p>
                                    </td>
                                    <td style="width: 15%" >
                                        <p class="text-xs px-3 font-weight-bold mb-0">${{$item->discount}}</p>
                                    </td>
                                    <td style="width: 15%" >
                                        <p class="text-xs px-3 font-weight-bold mb-0">${{$item->tax_amount}}</p>
                                    </td>
                                    <td style="width: 15%" >        
                                        <p class="text-xs px-3 font-weight-bold mb-0">${{$item->order_amount}}</p>
                                    </td>
                                    @php
                                        $total_sales+=$item->order_amount;
                                        $total_tax+=$item->tax_amount;
                                    @endphp
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row align-items-center px-4 mb-3">
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total Invoices:</span>
                            <span class="text-sm text-dark ms-2 fw-600 mb-0">{{$orders->count()}}</span>
                        </div>
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total Sales:</span>
                            <span class="text-sm text-dark ms-2 fw-600 mb-0">${{$total_sales}}</span>
                        </div>
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total Tax Amount:</span>
                            <span class="text-sm text-dark ms-2 fw-600 mb-0">${{$total_tax}}</span>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-success me-2 mb-0" wire:click="downloadPDF">Download Report</button>
                            <a type="button" class="btn btn-warning mb-0" href="{{url('print/sales/'.$this->date1.'/'.$this->date2)}}" target="_blank">Print Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</div>
