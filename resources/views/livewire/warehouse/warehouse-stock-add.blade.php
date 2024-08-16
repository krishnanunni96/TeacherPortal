<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Add Stock Entry</h5>
        </div>
        <div class="col-auto">
            <a href="{{url('warehouse/stock')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
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
                            <select type="text" class="form-control" wire:model="staff_id" placeholder="Select a Staff">
                                <option class="form-select" value="" selected>Select a Staff</option>
                                @foreach ($staffs as $value)
                                    <option class="form-select" value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                            @error('staff_id') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="date" class="form-control" wire:model="date">
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control" wire:model="order_no" readonly>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Search Products" wire:model="product_search">
                            @if ($product_search)
                            <ul class="list-group position-fixed" style="width: 21.25%; z-index:9;">
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
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-3">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Product</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">QTY</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prod as $key=>$value)
                                    <tr>
                                        <td>
                                            <h6 class="mb-1 text-sm px-3">{{$value['name']}}</h6>
                                        </td>
                                        <td class="">
                                            <div class="input-group align-items-center">
                                                <div class="badge bg-secondary text-xxs text-center p-66" type="button" wire:click="quantitySub({{$key}})"><i class="@if($quantity[$key]==1) fa fa-trash @else fa fa-minus @endif"></i></div>
                                                <input type="number" class="form-control form-control-sm text-center input-counter" wire:model="quantity.{{$key}}">
                                                <div class="badge bg-primary text-xxs text-center p-66" type="button" wire:click="quantityAdd({{$key}})"><i class="fa fa-plus"></i></div>
                                            </div>
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
                        <span class="text-sm mb-0 fw-500">Total QTY:</span>
                        <span class="text-sm text-dark ms-2 fw-600 mb-0">{{$total_qty}}</span>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger me-2 mb-0" wire:click="resetfn">Clear All</button>
                        <button type="submit" class="btn btn-primary mb-0" wire:click.prevent="save">Save Entry</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
