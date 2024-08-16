<div>

<div class="row align-items-center justify-content-between mb-4">
    <div class="col">
        <h5 class="fw-500 text-white">Service Addons</h5>
    </div>
    <div class="col-auto">
        <a wire:click.prevent="resetFn()" data-bs-toggle="modal" data-bs-target="#addaddon" class="btn btn-icon btn-3 btn-white text-primary mb-0">
            <i class="fa fa-plus me-2"></i> Add New Addon
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
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Addon</th>
                                <th class="text-uppercase text-secondary text-xs  opacity-7">Price</th>
                                <th class="text-center text-uppercase text-secondary text-xs opacity-7">Status</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order_addons as $data)
                                <tr>
                                    <td>
                                        <p class="text-sm px-3 mb-0">{{$loop->index+1}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{$data->addon_name}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold px-3 mb-0">${{$data->addon_price}}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if($data->is_active==1)
                                            <a type="button" class="badge badge-sm bg-success">Active</a>
                                        @else
                                            <a type="button" class="badge badge-sm bg-secondary">Inactive</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a wire:click="edit({{$data->id}})" data-bs-toggle="modal" data-bs-target="#editaddon"  type="button" class="badge badge-xs badge-warning fw-600 text-xs">
                                            Edit
                                        </a>
                                        <a href="#" wire:click.prevent="delete({{$data->id}})" type="button" class="ms-2 badge badge-xs badge-danger text-xs fw-600">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert">
                                    <span class="text-danger">query returned zero result...</span>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade " id="addaddon" tabindex="-1" role="dialog" aria-labelledby="addaddon" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600" id="addaddon">Add Addon</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <label class="form-label">Addon Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="addon_name" class="form-control @error('addon_name') is-invalid @enderror" placeholder="Enter Addon Name">
                            @error('addon_name') <span class="invalid-feedback">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Addon Price <span class="text-danger">*</span></label>
                            <input type="number" wire:model="addon_price" class="form-control @error('addon_price') is-invalid @enderror" placeholder="Enter Amount">
                            @error('addon_price') <span class="invalid-feedback">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" wire:model="is_active" type="checkbox" id="employee" checked>
                                <label class="form-check-label" for="employee">Is Active ?</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetFn">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade " id="editaddon" tabindex="-1" role="dialog" aria-labelledby="editaddon" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600" id="editaddon">Edit Service Type</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <label class="form-label">Addon Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="addon_name" class="form-control @error('addon_name') is-invalid @enderror" placeholder="Enter Addon Name">
                            @error('addon_name') <span class="invalid-feedback">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Addon Price <span class="text-danger">*</span></label>
                            <input type="number" wire:model="addon_price" class="form-control @error('addon_price') is-invalid @enderror" placeholder="Enter Amount">
                            @error('addon_price') <span class="invalid-feedback">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" wire:model="is_active" type="checkbox" id="employee" @if($is_active==1) checked @endif>
                                <label class="form-check-label" for="employee">Is Active ?</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetFn">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="update">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>