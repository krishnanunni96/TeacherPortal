<div>

    <div class="card mb-4">
        <div class="card-header p-4">
            <div class="row">
                <div class="col-md-12">
                    <label>Stock Report</label>
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
        </div>
    </div>

</div>
