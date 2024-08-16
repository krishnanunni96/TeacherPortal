<div>

    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Report Card</h5>
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
                                        Name</th>
                                    <th style="width: 25%" class="text-uppercase text-secondary text-xs opacity-7">
                                        Subject</th>
                                    <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Mark
                                    </th>
                                    <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Batch</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="table-responsive mb-4 table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered align-items-center mb-0 ">
                            <tbody>
                                @foreach ($customers as $data)
                                    <tr>
                                        <td style="width: 10%">
                                            <p class="text-xs px-3  mb-0">{{ $data->created_at }}</p>
                                        </td>
                                        <td style="width: 25%">
                                            <p class="text-xs px-3 mb-0">
                                                <span class="font-weight-bold">{{ $data->name }}</span>
                                            </p>
                                        </td>
                                        <td style="width: 25%">
                                            <p class="text-xs px-3 font-weight-bold mb-0">{{ $data->subject }}</p>
                                        </td>
                                        <td style="width: 20%">
                                            <p class="text-xs px-3 font-weight-bold mb-0">{{ $data->mark }}</p>
                                        <td style="width: 20%">
                                            <p class="text-xs px-3 text-uppercase mb-0">{{ $data->batch }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row align-items-center px-4 mb-3">
                        <div class="col">
                            <span class="text-sm mb-0 fw-500">Total Reports:</span>
                            <span class="text-sm text-dark ms-2 fw-600 mb-0">{{ $customers->count() }}</span>
                        </div>
                        <div class="col-auto">
                            <button type="button" wire:click="downloadPDF" class="btn btn-success me-2 mb-0">Download
                                Report</button>
                            <a type="button" href="{{url('print-report/'.$this->date1.'/'.$this->date2)}}" target="_blank" class="btn btn-warning mb-0">Print
                                Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>