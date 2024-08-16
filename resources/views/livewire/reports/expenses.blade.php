<div>

    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Expense Report</h5>
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
                                    <th style="width: 10%" class="text-uppercase text-secondary text-xs opacity-7">Date
                                    </th>
                                    <th style="width: 25%" class="text-uppercase text-secondary text-xs opacity-7">
                                        Towards</th>
                                    <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">
                                        Expense Amount</th>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Tax%
                                    </th>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Tax
                                        Amount</th>
                                    <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">
                                        Payment Mode</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="table-responsive mb-4 table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered align-items-center mb-0 ">
                            <tbody>
                                @foreach ($expenses as $data)
                                    <tr>
                                        <td style="width: 10%">
                                            <p class="text-xs px-3  mb-0">{{ $data->date }}</p>
                                        </td>
                                        <td style="width: 25%">
                                            <p class="text-xs px-3 mb-0">
                                                <span class="font-weight-bold">{{ $data->category->name }}</span>
                                            </p>
                                        </td>
                                        <td style="width: 20%">
                                            <p class="text-xs px-3 font-weight-bold mb-0">{{ $data->amount }}</p>
                                        </td>
                                        <td style="width: 15%">
                                            <p class="text-xs px-3 font-weight-bold mb-0">
                                                @php
                                                    if ($data->tax_included) {
                                                        echo $data->tax_percentage;
                                                    } else {
                                                        echo '-';
                                                    }
                                                @endphp
                                            </p>
                                        </td>
                                        @php
                                            if ($data->tax_included) {
                                                $tax_amount = ($data->amount * $data->tax_percentage) / 100;
                                            } else {
                                                $tax_amount = 0;
                                            }
                                            $total_taxamount += $tax_amount;
                                        @endphp
                                        <td style="width: 15%">
                                            <p class="text-xs px-3 font-weight-bold mb-0">
                                                @php
                                                    if ($tax_amount) {
                                                        echo $tax_amount;
                                                    } else {
                                                        echo '-';
                                                    }
                                                @endphp</p>
                                        </td>
                                        <td style="width: 15%">
                                            <p class="text-xs px-3 text-uppercase mb-0">
                                                {{ getPaymentMode($data->payment_mode) }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row align-items-center px-4 mb-3">
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total Invoices:</span>
                            <span class="text-sm text-dark ms-2 fw-600 mb-0">{{ $expenses->count() }}</span>
                        </div>
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total Sales:</span>
                            <span class="text-sm text-dark ms-2 fw-600 mb-0">$</span>
                        </div>
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total Tax Amount:</span>
                            <span
                                class="text-sm text-dark ms-2 fw-600 mb-0">${{ number_format($total_taxamount, 2) }}</span>
                        </div>
                        <div class="col-auto">
                            <button type="button" wire:click="downloadPDF" class="btn btn-success me-2 mb-0">Download
                                Report</button>
                            <a type="button" href="{{url('print/expense/'.$this->date1.'/'.$this->date2)}}" target="_blank" class="btn btn-warning mb-0">Print
                                Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>