<div>

    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Services</h5>
        </div>
        <div class="col-auto">
            <a href="{{url('service/add')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
                <i class="fa fa-plus me-2"></i> Add New Service
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
                                    <th class="text-uppercase text-secondary text-xs opacity-7">Service Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xs opacity-7">Service Types</th>
                                    <th class="text-center text-uppercase text-secondary text-xs  opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $item)
                                <tr>
                                    <td>
                                        <p class="text-sm px-3 mb-0">{{$loop->index+1}}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div>
                                                @if ($item->icon=='Baby Cloths')
                                                    <img src="{{asset('assets/img/service-icons/baby-clothes.png')}}" class="avatar avatar-sm me-3">
                                                @elseif($item->icon=='Female')
                                                    <img src="{{asset('assets/img/service-icons/woman-clothes.png')}}" class="avatar avatar-sm me-3">
                                                @elseif($item->icon=='Other')
                                                    <img src="{{asset('assets/img/service-icons/full-suit.png')}}" class="avatar avatar-sm me-3">
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        @foreach ($servicetypes as $data)
                                            @if($data->service_id==$item->id)
                                                <span class="badge badge-sm bg-dark rounded-pill fw-500">{{$data->type_name}}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle text-center">
                                        @if ($item->is_active==1)
                                            <a type="button" class="badge badge-sm bg-success">Active</a>
                                        @else
                                            <a type="button" class="badge badge-sm bg-secondary">In-Active</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('service/edit/'.$item->id)}}"  type="button" class="badge badge-xs badge-warning fw-600 text-xs">
                                            Edit
                                        </a>
                                        <a href="#" wire:click="delete({{$item->id}})" type="button" class="ms-2 badge badge-xs badge-danger text-xs fw-600">
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
    
</div>