<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Stock Report</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Search Here" wire:model="search">
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 5%" class="text-uppercase text-secondary text-xs opacity-7">#</th>
                                    <th style="width: 30%" class="text-uppercase text-secondary text-xs opacity-7">Product</th>
                                    <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Purchased Stock</th>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Stock Entries</th>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">In-Stock QTY</th>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Stock Value</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="table-responsive mb-4 table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered align-items-center mb-0 ">
                            <tbody>
                                @foreach ($products_2 as $key=>$data)
                                <tr>
                                    <td style="width: 5%" >
                                        <p class="text-xs px-3  mb-0">{{$loop->index+1}}</p>
                                    </td>
                                    <td style="width: 30%" >
                                        <p class="text-xs px-3 mb-0">
                                            <span class="font-weight-bold">{{$data->name}}</span>
                                        </p>
                                    </td>
                                    
                                    <td style="width: 20%" >
                                        <p class="text-xs px-3 mb-0">
                                            <span class="font-weight-bold">
                                                @foreach ($products as $value)
                                                    @if($data->name==$value->name)
                                                        {{$value->unit}}
                                                    @endif
                                                @endforeach
                                                </span>
                                            <span class="ms-1">Unit</span>
                                        </p>
                                    </td>
                                    <td style="width: 15%" >
                                        <p class="text-xs px-3 mb-0">
                                            <span class="font-weight-bold">{{$data->quantity}}</span>
                                            <span class="ms-1">Unit</span>
                                        </p>
                                    </td>
                                    <td style="width: 15%" >
                                        <p class="text-xs px-3 mb-0">
                                            <span class="font-weight-bold">        
                                                @foreach ($products as $value)                                        
                                                    @if($data->name==$value->name)
                                                        {{$value->unit-$data->quantity}}
                                                    @endif
                                                    @php
                                                        $total_instock+=($value->unit-$data->quantity);
                                                    @endphp
                                                    @endforeach
                                            </span>
                                            <span class="ms-1">Unit</span>
                                        </p>
                                    </td>
                                    <td style="width: 15%" >
                                        <p class="text-xs px-3 font-weight-bold mb-0">$
                                            @foreach ($products as $value)
                                            @if ($data->name==$value->name)
                                                {{$value->unit*$value->price}}
                                            @endif
                                            @endforeach
                                        </p>
                                        @php
                                            $total_stock_value+=($value->unit*$value->price);
                                        @endphp
                                    
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row align-items-center px-4 mb-3">
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total In-Stock QTY:</span>
                            <span class="text-sm text-dark ms-2 fw-600 mb-0">{{$total_instock}}</span>
                        </div>
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total Stock Value:</span>
                            <span class="text-sm text-dark ms-2 fw-600 mb-0">${{$total_stock_value}}</span>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-success me-2 mb-0" wire:click="downloadPDF">Download Report</button>
                            <a type="button" class="btn btn-warning mb-0" href="{{url('print/stocks')}}" target="_blank">Print Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
