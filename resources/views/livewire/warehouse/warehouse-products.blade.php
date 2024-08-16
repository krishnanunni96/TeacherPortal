<div>

<div class="row align-items-center justify-content-between mb-4">
    <div class="col">
        <h5 class="fw-500 text-white">Warehouse Products</h5>
    </div>
    <div class="col-auto">
        <a data-bs-toggle="modal" wire:click.prevent="resetfn" data-bs-target="#addproduct" class="btn btn-icon btn-3 btn-white text-primary mb-0">
            <i class="fa fa-plus me-2"></i> Add New Product
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
                                <th class="text-uppercase text-secondary text-xs opacity-7">#</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Product</th>
                                <th class="text-uppercase text-secondary text-xs  opacity-7">Unit</th>
                                <th class="text-uppercase text-secondary text-xs  opacity-7">Price</th>
                                <th class="text-uppercase text-secondary text-xs  opacity-7">Tax %</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $item)
                                <tr>
                                    <td>
                                        <p class="text-sm px-3 mb-0">{{$loop->index+1}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{$item->name}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm px-3 mb-0">{{getUnit($item->unit)}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm px-3 mb-0">${{$item->price}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm px-3 mb-0">{{$item->tax_percentage}}</p>
                                    </td>
                                    <td>
                                        <a wire:click="edit({{$item->id}})" data-bs-toggle="modal" data-bs-target="#editproduct"  type="button" class="badge badge-xs badge-warning fw-600 text-xs">
                                            Edit
                                        </a>
                                        <a wire:click.prevent="delete({{$item->id}})" href="#" type="button" class="ms-2 badge badge-xs badge-danger text-xs fw-600">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert">
                                    <span class="text-danger">query returned zero result..</span>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="addproduct" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600">Add Product</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Product Name">
                            @error('name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Purchase Price <span class="text-danger">*</span></label>
                            <input type="number" wire:model="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter Amount">
                            @error('price') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Product Unit <span class="text-danger">*</span></label>
                            <select class="form-select" wire:model="unit">
                            <option class="select-box" value="" disabled>Select a Unit</option>
                            <option class="select-box" value="1">NOS</option>
                            <option class="select-box" value="2">Pkt</option>
                            <option class="select-box" value="3">Box</option>
                            <option class="select-box" value="4">Bag</option>
                            <option class="select-box" value="5">Ltr</option>
                            <option class="select-box" value="6">Ml</option>
                            <option class="select-box" value="7">Kg</option>
                            <option class="select-box" value="8">Gm</option>
                            <option class="select-box" value="9">Tonne</option>
                            <option class="select-box" value="10">Dzn</option>
                        </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Product Tax % <span class="text-danger">*</span></label>
                            <input type="number" wire:model="tax_percentage" class="form-control @error('tax_percentage') is-invalid @enderror" placeholder="Enter Tax Rate">
                            @error('tax_percentage') <span class="text-danger">{{$message}}</span> @enderror
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetfn">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade " id="editproduct" tabindex="-1" role="dialog" aria-labelledby="editproduct" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600">Edit Product</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Product Name">
                            @error('name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Purchase Price <span class="text-danger">*</span></label>
                            <input type="number" wire:model="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter Amount">
                            @error('price') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Product Unit <span class="text-danger">*</span></label>
                            <select class="form-select" wire:model="unit">
                            <option class="select-box" value="" disabled>Select a Unit</option>
                            <option class="select-box" value="1">NOS</option>
                            <option class="select-box" value="2">Pkt</option>
                            <option class="select-box" value="3">Box</option>
                            <option class="select-box" value="4">Bag</option>
                            <option class="select-box" value="5">Ltr</option>
                            <option class="select-box" value="6">Ml</option>
                            <option class="select-box" value="7">Kg</option>
                            <option class="select-box" value="8">Gm</option>
                            <option class="select-box" value="9">Tonne</option>
                            <option class="select-box" value="10">Dzn</option>
                        </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Product Tax % <span class="text-danger">*</span></label>
                            <input type="number" wire:model="tax_percentage" class="form-control @error('tax_percentage') is-invalid @enderror" placeholder="Enter Tax Rate">
                            @error('tax_percentage') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="employee" wire:model="is_active" @if($is_active==1) checked @endif>
                                <label class="form-check-label" for="employee">Is Active ?</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetfn">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
