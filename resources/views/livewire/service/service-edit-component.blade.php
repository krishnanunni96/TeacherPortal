<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Edit Service</h5>
        </div>
        <div class="col-auto">
            <a href="{{url('service')}}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
                <i class="fa fa-arrow-left me-2"></i> Back
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form>
                    <div class="card-body p-3 mb-1 mt-2">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label class="form-label">Service Name</label>
                                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Service Name">
                                @error('name')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Icon <span class="text-danger">*</span></label>
                                <select class="form-select" wire:model="icon">
                                    <option class="select-box">Select Icon</option>
                                    <option class="select-box" value="Baby Cloths"><img src="assets/img/service-icons/baby-dress.png">Baby Clothes</option>
                                    <option class="select-box" value="Female"><img src="assets/img/service-icons/women-clothes.png">Female</option>
                                    <option class="select-box" value="Other"><img src="assets/img/service-icons/full-suit.png">Full Suit</option>
                                </select>
                            </div>
                            <div class="col-md-3 text-center ">
                                <div class="avatar avatar-xl">
                                @if($icon=='Baby Cloths')
                                    <img src="{{asset('assets/img/service-icons/baby-clothes.png')}}" class="rounded bg-light p-2">
                                @elseif($icon=='Female')
                                    <img src="{{asset('assets/img/service-icons/woman-clothes.png')}}" class="rounded bg-light p-2">
                                @elseif($icon=='Other')
                                    <img src="{{asset('assets/img/service-icons/full-suit.png')}}" class="rounded bg-light p-2">
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs opacity-7">#</th>
                                        <th class="text-uppercase text-secondary text-xs opacity-7 ps-3">Service Type</th>
                                        <th class="text-uppercase text-secondary text-xs opacity-7 ps-3">Service Price</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($var as $key => $row)
                                        <tr>
                                            <td>
                                                <p class="text-sm px-3 mb-0">{{$loop->index+1}}</p>
                                            </td>
                                            <td>
                                                <select class="form-select" wire:model="type_name.{{$key}}" style="width: 350px;">
                                                    @foreach ($servicetypes as $item)
                                                        <option value="{{$item->type_name}}" class="select-box" >{{$item->type_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">
                                                <input type="text" class="form-control @error('price.'.$key) is-invalid @enderror" wire:model="price.{{$key}}" style="width: 150px;">
                                                @error('price.'.$key)
                                                    <span class="invalid-feedback">{{$message}}</span>
                                                @enderror
                                            </td>
                                            <td class="align-middle">
                                                <a href="#" wire:click.prevent="remove({{$key}})" class="text-danger fw-600">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>  
                                        @endforeach
                                </tbody>
                            </table>
                            <div class="footer-button px-5">
                                <a href="#" wire:click.prevent="add" class="badge badge-xs badge-success fw-600 text-xs">Add Service Type</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-footer p-2 mx-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="form-check form-switch">
                                <input class="form-check-input" wire:model="is_active" type="checkbox" id="employee" @if($is_active==1) checked @endif>
                                <label class="form-check-label" for="employee">Is Active ?</label>
                            </div>
                            <div>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                                <button type="submit" wire:click.prevent="update" class="btn btn-primary ms-4">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>