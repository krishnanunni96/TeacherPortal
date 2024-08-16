<div>

<div class="row align-items-center justify-content-between mb-4">
    <div class="col">
        <h5 class="fw-500 text-white">User</h5>
    </div>
    <div class="col-auto">
        <a data-bs-toggle="modal" wire:click="resetInput" data-bs-target="#addexpense" class="btn btn-icon btn-3 btn-white text-primary mb-0">
            <i class="fa fa-plus me-2"></i> Add New User
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header p-4">
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Search with Name or Mobile" wire:model="search">
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    @if($tests->count())
                    <table class="table align-items-center mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xs opacity-7">Name</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Mobile</th>
                                <th class="text-uppercase text-secondary text-xs  opacity-7">Email</th>
                                <th class="text-center text-uppercase text-secondary text-xs opacity-7">Is Active?</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Avatar</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Address</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tests as $data)
                            <tr>
                                <td>
                                    <p class="text-sm px-3 mb-0">{{$data->name}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{$data->phone}}</p>
                                </td>
                                <td>
                                    <p class="text-sm px-3 mb-0">{{$data->email}}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="form-check form-switch ml-4">
                                    <input class="form-check-input"  @if($data->is_active==1) checked @endif wire:click="toggleStatus({{$data->id}})" type="checkbox" role="switch" >
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm mb-0 text-uppercase">
                                        @if(($data->avatar) && file_exists(public_path($data->avatar)))
                                        <img src="{{ asset($data->avatar) }}" height="50" width="50">
                                        @else
                                        <img src="{{asset('assets/img/xfortech.png')}}" class="bg-dark" height="50" width="50">
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <p class="text-sm mb-0 text-uppercase">{{$data->address}}</p>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" wire:click="edit({{$data->id}})" data-bs-target="#editexpense" type="button" class="badge badge-xs badge-warning fw-600 text-xs">
                                        Edit
                                    </a>
                                    <a href="#" wire:click.prevent="delete({{$data->id}})" type="button" class="ms-2 badge badge-xs badge-danger text-xs fw-600">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>    
                    @else
                        <div class="alert alert-dismissible" role="alert">
                            <span class="text-danger">query returned zero results.</span> 
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="addexpense" tabindex="-1" role="dialog" aria-labelledby="addexpense" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600" id="addexpense">Add User</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype=multipart/form-data>
                <div class="modal-body">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-12 mb-1">
                            <label class="form-label">Mobile <span class="text-danger">*</span></label>
                            <input type="number" wire:model="phone" class="form-control">
                            @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-12 mb-1">
                            <label class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" wire:model="email" class="form-control" placeholder="Enter email">
                            @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Avatar</label>
                            <input type="file" class="form-control" wire:model="avatar">
                        </div>
                        
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Address<span class="text-danger">*</span></label>
                            <input type="textarea" wire:model="address" class="form-control" placeholder="Enter address">
                            @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:click.prevent="save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade " id="editexpense" tabindex="-1" role="dialog" aria-labelledby="editexpense" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600" id="editexpense">Edit Expense</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype=multipart/form-data>
                <div class="modal-body">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-12 mb-1">
                            <label class="form-label">Mobile <span class="text-danger">*</span></label>
                            <input type="number" wire:model="phone" class="form-control">
                            @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-12 mb-1">
                            <label class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" wire:model="email" class="form-control" placeholder="Enter email">
                            @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Avatar</label>
                            <input type="file" class="form-control" wire:model="avatar">
                        </div>
                        
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Address<span class="text-danger">*</span></label>
                            <input type="textarea" wire:model="address" class="form-control" placeholder="Enter address">
                            @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:click.prevent="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


</div>