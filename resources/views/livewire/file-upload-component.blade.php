<div>

<div class="row align-items-center justify-content-between mb-4">
    <div class="col">
        <h5 class="fw-500 text-white">File upload</h5>
    </div>
    <div class="col-auto">
        <a data-bs-toggle="modal" wire:click="resetInput" data-bs-target="#addcategory" class="btn btn-icon btn-3 btn-white text-primary mb-0">
            <i class="fa fa-plus me-2"></i> Add New Category
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header p-4">
                <div class="row">
                    <div class="col-md-12">
                        <!-- <input type="text" class="form-control" placeholder="Search Here"> -->
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xs opacity-7">#</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Title</th>
                                <th class="text-center text-uppercase text-secondary text-xs opacity-7">Filename</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $data)
                            <tr>
                                <td>
                                    <p class="text-sm px-3 mb-0">{{$loop->index+1}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{$data->title}}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <a type="button" class="badge badge-sm bg-dark text-uppercase">
                                        @if(($data->imagename!='') && file_exists(public_path($data->imagename)))
                                        <img src="{{asset($data->imagename)}}" height="100" width="100">
                                        @else
                                        <img src="{{asset('assets/img/xfortech.png')}}" height="100" width="100">
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a wire:click="" data-bs-toggle="modal" data-bs-target="#editcategory"  type="button" class="badge badge-xs badge-warning fw-600 text-xs">
                                        Edit
                                    </a>
                                    <a wire:click.prevent="delete({{$data->id}})" href="#" type="button" class="ms-2 badge badge-xs badge-danger text-xs fw-600">
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

<div wire:ignore.self class="modal fade " id="addcategory" tabindex="-1" role="dialog" aria-labelledby="addcategory" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600" id="addcategory">Add File</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-12 mb-1">
                                <label class="form-label">Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter name" wire:model="title">
                                @error('title') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-12 mb-1">
                                <label class="form-label">Upload image<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" wire:model="imagename">
                                @error('imagename') <span class="error text-danger">{{ $message }}</span> @enderror
                                    <div wire:loading wire:target="imagename" class="justify-content-center">
                                            Loading
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                              </div>
                                    </div>
                            </div>
                                @if($imagename)
                                    <img src="{{ $imagename->temporaryUrl() }}">
                                @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" >Cancel</button>
                        <button class="btn btn-primary" wire:click.prevent="save">Save</button>
                    </div>
                </form>
        </div>
    </div>
</div>

</div>
