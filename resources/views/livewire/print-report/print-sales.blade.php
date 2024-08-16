<div>

    <div class="card mb-4">
        <div class="card-header p-4">
            <div class="row">
                <div class="col-md-4">
                    <label>Sales Report</label>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
