<div>

<div class="row align-items-center justify-content-between mb-4">
    <div class="col">
        <h5 class="fw-500 text-white">Students Mark Sheet</h5>
    </div>
    <div class="col-auto">
        <a wire:click="resetInput()" data-bs-toggle="modal" data-bs-target="#addcustomer" class="btn btn-icon btn-3 btn-white text-primary mb-0">
            <i class="fa fa-plus me-2"></i> Add New Student
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header p-4">
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Search here using Name or Batch" wire:model="search">
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table wire:poll class="table align-items-center mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xs opacity-7">#</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Student Name</th>
                                <th class="text-uppercase text-secondary text-xs  opacity-7">Mark</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Subject</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Batch</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $data)
                        
                            <tr>
                                <td>
                                    <p class="text-sm px-3 mb-0">{{$loop->index+1}}</p>
                                </td>
                                <td>
                                    <p class="text-sm mb-0">
                                    @if (($data->avatar) && file_exists(public_path($data->avatar)))
                                        <img src="{{asset($data->avatar)}}" height="50" width="50" style="border-radius: 50%;">
                                    @else
                                        <img src="{{asset('assets/img/user-2.png')}}" height="50" width="50" style="border-radius: 50%;">
                                    @endif
                                    <span style="padding-left:10px;">{{$data->name}}</span></p>
                                </td>
                                <td>
                                    <p class="text-sm px-3 mb-0">{{$data->mark}}</p>
                                </td>
                                <td>
                                    <p class="text-sm mb-0">{{$data->subject}}</p>
                                </td>
                                <td>
                                    <p class="text-sm mb-0">{{$data->batch}}</p>
                                </td>
                                <td>
                                    <a wire:click.prevent="view({{$data->id}})" data-bs-toggle="modal" data-bs-target="#viewcustomer"  href="#" type="button" class="ms-2 badge badge-xs badge-primary text-xs fw-600">
                                        Info
                                    </a>
                                    <a wire:click="edit({{$data->id}})" data-bs-toggle="modal" data-bs-target="#editcustomer"  type="button" class="badge badge-xs badge-warning fw-600 text-xs">
                                        Edit
                                    </a>
                                    <a wire:click.prevent="alertConfirm({{$data->id}})" href="#" type="button" class="ms-2 badge badge-xs badge-danger text-xs fw-600">
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

<div wire:ignore.self class="modal fade " id="addcustomer" tabindex="-1" role="dialog" aria-labelledby="addcustomer" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600" id="addcustomer">Add Student</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Student Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control" placeholder="Enter Student Name">
                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Subject <span class="text-danger">*</span></label>
                            <input type="text" wire:model="subject" class="form-control" placeholder="Enter Subject">
                            @error('subject') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Mark <span class="text-danger">*</span></label>
                            <input type="number" wire:model="mark" class="form-control" placeholder="Enter Mark">
                            @error('mark') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Batch <span class="text-danger">*</span></label>
                            <input type="text" wire:model="batch" class="form-control" placeholder="Enter Batch">
                            @error('batch') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Phone Number </label>
                            <input type="number" wire:model="mobile" class="form-control" placeholder="Enter Phone Number">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Email ID</label>
                            <input type="email" wire:model="email" class="form-control" placeholder="Enter Email ID">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Avatar</label>
                            <input type="file" wire:model="avatar" class="form-control" >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address</label>
                            <textarea type="text" wire:model="address" class="form-control" placeholder="Enter Student Address"></textarea>
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
                    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary" wire:click.prevent="save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade " id="editcustomer" tabindex="-1" role="dialog" aria-labelledby="editcustomer" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600" id="editcustomer">Edit Student</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Student Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control" placeholder="Enter Student Name">
                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Subject <span class="text-danger">*</span></label>
                            <input type="text" wire:model="subject" class="form-control" placeholder="Enter Subject">
                            @error('subject') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Mark <span class="text-danger">*</span></label>
                            <input type="number" wire:model="mark" class="form-control" placeholder="Enter Mark">
                            @error('mark') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Batch <span class="text-danger">*</span></label>
                            <input type="text" wire:model="batch" class="form-control" placeholder="Enter Batch">
                            @error('batch') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Phone Number </label>
                            <input type="number" wire:model="mobile" class="form-control" placeholder="Enter Phone Number">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Email ID</label>
                            <input type="email" wire:model="email" class="form-control" placeholder="Enter Email ID">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Avatar</label>
                            <input type="file" wire:model="avatar" class="form-control" >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address</label>
                            <textarea type="text" wire:model="address" class="form-control" placeholder="Enter Student Address"></textarea>
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
                    <button type="submit" class="btn btn-primary" wire:click.prevent="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade " id="viewcustomer" tabindex="-1" role="dialog" aria-labelledby="viewcustomer" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600" id="viewcustomer">View Student</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Student Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control" placeholder="Enter Student Name">
                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Subject <span class="text-danger">*</span></label>
                            <input type="text" wire:model="subject" class="form-control" placeholder="Enter Subject">
                            @error('subject') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Mark <span class="text-danger">*</span></label>
                            <input type="number" wire:model="mark" class="form-control" placeholder="Enter Mark">
                            @error('mark') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Batch <span class="text-danger">*</span></label>
                            <input type="text" wire:model="batch" class="form-control" placeholder="Enter Batch">
                            @error('batch') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Phone Number </label>
                            <input type="number" wire:model="mobile" class="form-control" placeholder="Enter Phone Number">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Email ID</label>
                            <input type="email" wire:model="email" class="form-control" placeholder="Enter Email ID">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Avatar</label>
                            <input type="file" wire:model="avatar" class="form-control" >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address</label>
                            <textarea type="text" wire:model="address" class="form-control" placeholder="Enter Student Address"></textarea>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>