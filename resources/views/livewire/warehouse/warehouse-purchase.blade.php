<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Warehouse Purchase</h5>
        </div>
        <div class="col-auto">
            <a href="{{url('warehouse/purchase/add')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
                <i class="fa fa-plus me-2"></i> Add New Purchase
            </a>
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
                        <table class="table align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Date</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Purchase Number</th>
                                    <th class="text-uppercase text-secondary text-xs  opacity-7">Supplier</th>
                                    <th class="text-uppercase text-secondary text-xs  opacity-7">Purchase Amount</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $data)
                                <tr>
                                    <td>
                                        <p class="text-sm px-3 mb-0">{{dateHelper($data->purchase_date)}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm px-3 mb-0">
                                            <span class="font-weight-bold">{{$data->purchase_no}}</span>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-sm px-3 font-weight-bold mb-0">{{$data->supplier->name}}</p>
                                        <p class="text-sm px-3 mb-0">+91 {{$data->supplier->mobile}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm px-3 font-weight-bold mb-0">${{$data->gross_total}}</p>
                                    </td>
                                    <td>
                                        <a href="{{url('warehouse/purchase/preview/'.$data->id)}}" type="button" class="badge badge-xs badge-primary text-xs fw-600">
                                            View
                                        </a>
                                        <a href="{{url('warehouse/purchase/edit/'.$data->id)}}" type="button" class="badge badge-xs badge-warning text-xs fw-600">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
