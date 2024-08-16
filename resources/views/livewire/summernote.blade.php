<div>
<div class="row align-items-center justify-content-between mb-4">
    <div class="col">
        <h5 class="fw-500 text-white">Summernote - Daily stuff</h5>
    </div>
    <div class="col-auto">
        <!-- <a wire:click="resetInput" data-bs-toggle="modal" data-bs-target="#addcustomer" class="btn btn-icon btn-3 btn-white text-primary mb-0">
            <i class="fa fa-plus me-2"></i> Add New Customer
        </a> -->
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <form>
                <div wire:ignore class="card-body p-3 mb-1 mt-2">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <!--Summer Note-->
                            <label class="form-label">Privacy Policy</label>
                            <textarea id="summernote" wire:model.defer="policy_note" class="form-control" rows="10" placeholder="Enter Details">{!! $policy_note !!}</textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-footer p-2 mx-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-check form-switch">
                            <input class="form-check-input" wire:click="toggleStatus({{$policy_id}})" type="checkbox" id="employee"  @if($is_active==1) checked @endif>
                            <label class="form-check-label" for="employee">Is Active ?</label>
                        </div>
                        <div>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                            <button wire:click.prevent="save" class="btn btn-primary ms-4">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>