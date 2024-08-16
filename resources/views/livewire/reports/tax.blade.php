<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Tax Report</h5>
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
                            <label>Filter</label>
                            <select class="form-select" wire:model="filter">
                                <option class="select-box" value="1">Sales</option>
                                <option class="select-box" value="2">Expense</option>
                                <option class="select-box" value="3">Purchase</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 5%" class="text-uppercase text-secondary text-xs opacity-7">#</th>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Date</th>
                                    <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Particulars #</th>
                                    <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Before Tax</th>
                                    <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Tax Amount</th>
                                    <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Total Amount</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="table-responsive mb-4 table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered align-items-center mb-0 ">
                            <tbody>
                                @foreach ($reports as $data)
                                <tr>
                                    <td style="width: 5%" >
                                        <p class="text-xs px-3  mb-0">{{$loop->index+1}}</p>
                                    </td>
                                    <td style="width: 15%" >
                                        @if($filter==1)
                                        <p class="text-xs px-3  mb-0">{{$data->date_of_order}}</p>
                                        @elseif($filter==3)
                                        <p class="text-xs px-3  mb-0">{{$data->purchase_date}}</p>
                                        @else
                                        <p class="text-xs px-3  mb-0">{{$data->date}}</p>
                                        @endif
                                    </td>
                                    <td style="width: 20%" >
                                        <p class="text-xs px-3 mb-0">
                                            @if($filter==1)
                                            <span class="font-weight-bold">{{$data->order_no}}</span>
                                            @elseif($filter==3)
                                            <span class="font-weight-bold">{{$data->purchase_no}}</span>
                                            @else
                                            <span class="font-weight-bold">{{$data->id}}</span>
                                            @endif
                                        </p>
                                    </td>
                                    <td style="width: 20%" >
                                        @if($filter==2)
                                            @if($data->tax_included==0)
                                            <p class="text-xs px-3 font-weight-bold mb-0">${{$data->amount}}</p>
                                            @else
                                            <p class="text-xs px-3 font-weight-bold mb-0">$
                                                @php
                                                    $amount=$data->amount-(($data->amount*$data->tax_percentage)/100);
                                                @endphp
                                                {{$amount}}</p>
                                            @endif
                                        @else
                                        <p class="text-xs px-3 font-weight-bold mb-0">${{$data->sub_total}}</p>
                                        @endif
                                    </td>
                                    <td style="width: 20%" >
                                        @if($filter==1)
                                        <p class="text-xs px-3 font-weight-bold mb-0">${{$data->tax_amount}}</p>
                                        @elseif($filter==3)
                                        <p class="text-xs px-3 font-weight-bold mb-0">${{$data->tax_total}}</p>
                                        @else
                                            @if($data->tax_included)
                                            @php
                                                $tax_amt=($data->amount*$data->tax_percentage)/100;
                                            @endphp
                                            <p class="text-xs px-3 font-weight-bold mb-0">${{$tax_amt}}</p>
                                            @else
                                            -
                                            @endif
                                        @endif
                                    </td>
                                    <td style="width: 20%" >
                                        @if($filter==1)
                                        <p class="text-xs px-3 font-weight-bold mb-0">${{$data->order_amount}}</p>
                                        @elseif($filter==3)
                                        <p class="text-xs px-3 font-weight-bold mb-0">${{$data->gross_total}}</p>
                                        @else
                                        <p class="text-xs px-3 font-weight-bold mb-0">${{$data->amount}}</p>
                                        @endif
                                    </td>
                                        @php
                                            $total_amount1+=$data->tax_amount;
                                            $total_amount2+=$data->amount;
                                            $total_amount3+=$data->tax_total;
                                            $total_tax_amount1+=$data->order_amount;
                                            $total_tax_amount2+=$tax_amt;
                                            $total_tax_amount3+=$data->gross_total;
                                        @endphp
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row align-items-center px-4 mb-3">
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total Amount:</span>
                            <span class="text-sm text-dark ms-2 fw-600 mb-0">
                                @if($filter==1)
                                ${{$total_amount1}}
                                @elseif($filter==3)
                                ${{$total_amount3}}
                                @else
                                ${{$total_amount2}}
                                @endif
                            </span>
                        </div>
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total Tax Amount:</span>
                            <span class="text-sm text-dark ms-2 fw-600 mb-0">                                
                                @if($filter==1)
                                ${{$total_tax_amount1}}
                                @elseif($filter==3)
                                ${{$total_tax_amount3}}
                                @else
                                ${{$total_tax_amount2}}
                                @endif
                            </span>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-success me-2 mb-0" wire:click="downloadPDF">Download Report</button>
                            <a type="button" class="btn btn-warning mb-0" href="{{url('print/tax/'.$this->date1.'/'.$this->date2.'/'.$this->filter)}}" target="_blank">Print Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
