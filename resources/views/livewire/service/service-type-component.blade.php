<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Service Type</h5>
        </div>
        <div class="col-auto">
            <a wire:click="clear" data-bs-toggle="modal" data-bs-target="#addtype" class="btn btn-icon btn-3 btn-white text-primary mb-0">
                <i class="fa fa-plus me-2"></i> Add New Service Type
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
                                    <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Service Type</th>
                                    <th class="text-center text-uppercase text-secondary text-xs opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $item)
                                <tr>
                                    <td>
                                        <p class="text-sm px-3 mb-0">{{$loop->index+1}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{$item->type_name}}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if ($item->is_active==1)
                                            <a type="button" class="badge badge-sm bg-success">Active</a>
                                        @else
                                            <a type="button" class="badge badge-sm bg-secondary">In-Active</a>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a wire:click="edit({{$item->id}})" data-bs-toggle="modal" data-bs-target="#edittype"  type="button" class="badge badge-xs badge-warning fw-600 text-xs">
                                            Edit
                                        </a>
                                        <a wire:click.prevent="delete({{$item->id}})" href="#"  type="button" class="ms-2 badge badge-xs badge-danger text-xs fw-600">
                                            Delete
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
    
    <div wire:ignore.self class="modal fade " id="addtype" tabindex="-1" role="dialog" aria-labelledby="addtype" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">Add Service Type</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-12">
                                <label class="form-label">Service Type Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model="type_name" class="form-control @error('type_name') is-invalid @enderror" placeholder="Enter Service Type Name">
                                @error('type_name')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" wire:model="is_active" type="checkbox" id="employee" checked>
                                    <label class="form-check-label" for="employee">Is Active ?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="clear" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:click.prevent="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div wire:ignore.self class="modal fade " id="edittype" tabindex="-1" role="dialog" aria-labelledby="edittype" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">Edit Service Type</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-12">
                                <label class="form-label">Service Type Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model="type_name" class="form-control @error('type_name') is-invalid @enderror" placeholder="Enter Service Type Name">
                                @error('type_name')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" wire:model="is_active" type="checkbox" id="employee" @if($is_active==1) checked @endif>
                                    <label class="form-check-label" for="employee">Is Active ?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="clear">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:click.prevent="update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>