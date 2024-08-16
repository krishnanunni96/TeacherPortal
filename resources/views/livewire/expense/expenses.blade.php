<div>

<div class="row align-items-center justify-content-between mb-4">
    <div class="col">
        <h5 class="fw-500 text-white">Expense</h5>
    </div>
    <div class="col-auto">
        <a data-bs-toggle="modal" wire:click="resetInput" data-bs-target="#addexpense" class="btn btn-icon btn-3 btn-white text-primary mb-0">
            <i class="fa fa-plus me-2"></i> Add New Expense
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header p-4">
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control" wire:model="search_category">
                            <option value="">All categories</option>
                                @foreach($categories as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Search with amount" wire:model="search">
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xs opacity-7">Date</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Amount</th>
                                <th class="text-uppercase text-secondary text-xs  opacity-7">Towards</th>
                                <th class="text-center text-uppercase text-secondary text-xs opacity-7">Tax Included?</th>
                                <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Payment Mode</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($expenses as $data)
                            <tr>
                                <td>
                                    <p class="text-sm px-3 mb-0">{{$data->date}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{master()->currency_symbol}}{{number_format($data->amount,2)}}</p>
                                </td>
                                <td>
                                    <p class="text-sm px-3 mb-0">
                                        @foreach ($expense_details as $item)
                                            @if($data->id==$item->expense_id)
                                                <span class="badge badge-md bg-dark rounded-pill fw-500">{{$item->category->name}}</span>
                                            @endif
                                        @endforeach
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <a type="button" class="badge badge-sm bg-dark text-uppercase">{{getTaxIncluded($data->tax_included)}}</a>
                                </td>
                                <td>
                                    <p class="text-sm mb-0 text-uppercase">{{getPaymentMode($data->payment_mode)}}</p>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" wire:click="edit({{$data->id}})" data-bs-target="#editexpense" type="button" class="badge badge-xs badge-warning fw-600 text-xs">
                                        Edit
                                    </a>
                                    <a href="#" wire:click.prevent="alertConfirm({{$data->id}})" type="button" class="ms-2 badge badge-xs badge-danger text-xs fw-600">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <div class="alert" role="alert">
                                    <span class="text-danger">query returned zero results.</span> 
                                </div> 
                            @endforelse
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="addexpense" tabindex="-1" role="dialog" aria-labelledby="addexpense" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600" id="addexpense">Add Expense</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="date" class="form-control">
                            @error('date') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div wire:ignore class="col-md-12 mb-1">
                            <label class="form-label">Expense Category <span class="text-danger">*</span></label>
                            <select wire:model="category_id" class="form-control rounded-0" id="select2" multiple="multiple">
                            {{-- <option value="">select category</option> --}}
                                @foreach($categories as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Expense Amount <span class="text-danger">*</span></label>
                            <input type="number" wire:model="amount" class="form-control" placeholder="Enter Amount">
                            @error('amount') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Payment Mode</label>
                            <select class="form-control" wire:model="payment_mode">
                                <option value="1" class="select-box">CASH</option>
                                <option value="2" class="select-box">UPI</option>
                                <option value="3" class="select-box">CARD</option>
                                <option value="4" class="select-box">CHEQUE</option>
                                <option value="5" class="select-box">BANK TRANSFER</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label">Tax Included ?</label>
                                <div class="form-check ms-4">
                                    <input class="form-check-input" wire:model="tax_included" type="radio" value="0" id="no" name="tax" checked>
                                    <label class="form-check-label" for="no">NO</label>
                                </div>
                                <div class="form-check ms-2">
                                    <input class="form-check-input" wire:model="tax_included" type="radio" value="1" id="yes" name="tax">
                                    <label class="form-check-label" for="yes">YES</label>
                                </div>
                                <div class="ms-4">
                                    @if($tax_included==1)
                                    <input type="number" class="form-control" wire:model="tax_percentage"placeholder="Tax Percentage" style="width: 150px;">
                                    @endif
                                </div>
                            </div>
                        </div>                                
                        @error('tax_percentage') <span class="error text-danger" style="padding-left:100px;">{{ $message }}</span> @enderror
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
            <form>
            <div class="modal-body">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="date" class="form-control">
                            @error('date') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div wire:ignore class="col-md-12 mb-1">
                            <label class="form-label">Expense Category <span class="text-danger">*</span></label>
                            <select wire:model="category_id" class="form-control" id="editSelect2" multiple="multiple">
                                @foreach($categories as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Expense Amount <span class="text-danger">*</span></label>
                            <input type="number" wire:model="amount" class="form-control" placeholder="Enter Amount">
                            @error('amount') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Payment Mode</label>
                            <select class="form-select" wire:model="payment_mode">
                                <option value="1" class="select-box">CASH</option>
                                <option value="2"class="select-box">UPI</option>
                                <option value="3"class="select-box">CARD</option>
                                <option value="4"class="select-box">CHEQUE</option>
                                <option value="5"class="select-box">BANK TRANSFER</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label">Tax Included ?</label>
                                <div class="form-check ms-4">
                                    <input class="form-check-input" wire:model="tax_included" type="radio" value="0" id="no" name="tax" checked>
                                    <label class="form-check-label" for="no">NO</label>
                                </div>
                                <div class="form-check ms-2">
                                    <input class="form-check-input" wire:model="tax_included" type="radio" value="1" id="yes" name="tax">
                                    <label class="form-check-label" for="yes">YES</label>
                                </div>
                                @if($tax_included==1)
                                <div class="ms-4">
                                    <input type="number" class="form-control" wire:model="tax_percentage"placeholder="Tax Percentage" style="width: 150px;">
                                </div>
                                @endif
                            </div>
                        </div>
                        @error('tax_percentage') <span class="error text-danger" style="padding-left:100px;">{{ $message }}</span> @enderror
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

@push('scripts')
<script src="{{asset('assets/select2/select2.min.js')}}"></script>

    <script>
        $(document).ready(function() {
           
            $('#select2').select2({
            placeholder: 'Select multiple categories',
            width: '100%',
            }).on('change', function(e) {
                var data = $('#select2').select2("val");                        
                @this.set('category_id',data);
            });
        });

        livewire.on('edit_category', edit_category=>{
            $('#editSelect2').select2({ 
                width: '100%',
                }).val(edit_category).trigger('change').on('change', function(e) {
                var data2 = $('#editSelect2').select2("val");                        
                @this.set('category_id',data2);
            });            
        })
                                                                        

        
    </script>
@endpush

</div>
