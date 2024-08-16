<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Daily Report</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Date</label>
                            <input type="date" class="form-control" wire:model="date">
                        </div>
                        <div class="col-md-4">
                            <label>Branch</label>
                            <select class="form-select" disabled>
                                <option class="select-box" value="">All Branches</option>
                                <option class="select-box" value="">Branch 1</option>
                                <option class="select-box" value="">Branch 2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Particulars</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Value</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="text-sm px-3 mb-0">New Orders</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold text-warning mb-0">{{$new_orders}}</p>
                                    </td>
                                    
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm px-3 mb-0">No. of Orders Delivered</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold text-primary mb-0">{{$orders_delivered}}</p>
                                    </td>
                                    
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm px-3 mb-0">Total Sales</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold text-success mb-0">${{$total_sales}}</p>
                                    </td>
                                    
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm px-3 mb-0">Total Payment</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold text-info mb-0">${{$total_payment}}</p>
                                    </td>
                                    
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm px-3 mb-0">Total Expense</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold text-danger mb-0">${{$total_expense}}</p>
                                    </td>
                                    
                                    <td>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
</div>
