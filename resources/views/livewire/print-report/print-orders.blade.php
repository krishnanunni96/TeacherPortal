<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Order Report</h5>
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
                        </td>
                        <td style="width: 20%" >
                            <a type="button" class="badge badge-sm bg-secondary text-uppercase">{{getOrderStatus($item->status)}}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
