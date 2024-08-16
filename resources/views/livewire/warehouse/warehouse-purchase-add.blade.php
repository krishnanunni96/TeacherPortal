<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Add Purchase</h5>
        </div>
        <div class="col-auto">
            <a href="{{url('warehouse/purchase')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
                <i class="fa fa-arrow-left me-2"></i> Back
            </a>
        </div>
    </div>
    <div class="row match-height">
        <div class="col-lg-12 col-12">
            <div class="card mb-4">
                <div class="card-header p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="@if($supplier) {{$supplier->name}} @else Select a Supplier @endif" wire:model="supplier_search">
                                    @error('supplier_search') <span class="text-danger">{{$message}}</span> @enderror
                                    @if ($supplier_search)
                                    <ul class="list-group position-fixed" style="width: 29.8%; z-index:9;">
                                        @forelse ($supplier_search_results as $value)
                                            <a href="#" class="list-group-item list-group-item-action" wire:click.prevent="supplierSelect({{$value->id}})">{{$value->name}}</a>
                                        @empty
                                            <div class="alert">
                                                <span class="list-group-item list-group-item-action text-danger">query returned zero results.</span> 
                                            </div>
                                        @endforelse
                                    </ul>
                                    @endif
                                </div>
                                <div class="col-auto">
                                    <button type="button" wire:click="resetfn" class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addsupplier">
                                        <i class="fa fa-plus me-2"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" wire:model="purchase_date">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" wire:model="purchase_no" placeholder="Purchase Number" readonly>
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control @error('discount') is_invalid @enderror" wire:model="discount" placeholder="Discount Amount">
                            @error('discount') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" wire:model="product_search" placeholder="Search Products">
                            @if ($product_search)
                            <ul class="list-group position-fixed" style="width: 63%; z-index:9;">
                                @forelse ($product_search_results as $value)
                                    <a href="#" class="list-group-item list-group-item-action" wire:click.prevent="productSelect({{$value->id}})">{{$value->name}}</a>
                                @empty
                                    <div class="alert">
                                        <span class="list-group-item list-group-item-action text-danger">query returned zero results.</span> 
                                    </div>
                                @endforelse
                            </ul>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control @error('service_charge') is_invalid @enderror" wire:model="service_charge" placeholder="Service Charge">
                            @error('service_charge') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-3">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Product</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Rate</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">QTY</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Tax %</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Tax Amount</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prod as $key=>$value)
                                <tr>
                                    <td>
                                        <h6 class="mb-1 text-sm px-3">{{$value['name']}}</h6>
                                    </td>
                                    <td class="">
                                        <input type="number" class="form-control form-control-sm text-center" wire:model="rate.{{$key}}" style="width: 100px;">
                                    </td>
                                    <td class="">
                                        <div class="input-group align-items-center">
                                            <div class="badge bg-secondary text-xxs text-center p-66" type="button" wire:click="quantitySub({{$key}})"><i class="@if($quantity[$key]==1) fa fa-trash @else fa fa-minus @endif"></i></div>
                                            <input type="number" class="form-control form-control-sm text-center input-counter" wire:model="quantity.{{$key}}">
                                            <div class="badge bg-primary text-xxs text-center p-66" type="button" wire:click="quantityAdd({{$key}})"><i class="fa fa-plus"></i></div>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm text-center" wire:model="tax_percentage.{{$key}}" style="width: 70px;">
                                    </td>
                                    <td>
                                        <p class="text-sm px-3 mb-0">${{$tax_amount[$key]}}</p>
                                    </td>
                                    <td class="">
                                        <p class="text-sm px-3 mb-0">${{$sub_total[$key]}}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row align-items-center px-4 mb-3">
                    <div class="col">
                        <span class="text-sm mb-0 fw-500">Gross Total:</span>
                        <span class="text-sm text-success ms-2 fw-600 mb-0">${{$gross_total}}</span>
                    </div>
                    <div class="col">
                        <span class="text-sm mb-0 fw-500">Tax Total:</span>
                        <span class="text-sm text-warning ms-2 fw-600 mb-0">${{$tax_total}}</span>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger me-2 mb-0" wire:click=clearAll>Clear All</button>
                        <button type="submit" class="btn btn-primary mb-0" wire:click.prevent="savePurchase">Save Purchase</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <div wire:ignore.self class="modal fade" id="addsupplier" tabindex="-1" role="dialog" aria-labelledby="addsupplier" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">Add Supplier</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-12 mb-1">
                                <label class="form-label">Supplier Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model="supplier_name" class="form-control" placeholder="Enter Supplier Name">
                            </div>
                            <div class="col-md-12 mb-1">
                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="number" wire:model="mobile" class="form-control" placeholder="Enter Phone Number">
                            </div>
                            <div class="col-md-12 mb-1">
                                <label class="form-label">Tax Number</label>
                                <input type="text" wire:model="tax_number" class="form-control" placeholder="Enter Tax Number">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea type="text" wire:model="address" class="form-control" placeholder="Enter Supplier Address"></textarea>
                            </div>
                            <div class="col-md-12 mb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="employee" wire:model="is_active" checked>
                                    <label class="form-check-label" for="employee">Is Active ?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:click.prevent="saveSupplier">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
