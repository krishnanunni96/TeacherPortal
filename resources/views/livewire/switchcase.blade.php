<div>

<div class="row align-items-center justify-content-between mb-4">
    <div class="col">
        <h5 class="fw-500 text-white">Switch case - Daily stuff</h5>
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
            <div class="card-header p-4">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" wire:model="value" placeholder="Enter number">
                    </div>
                    <div class="col-md-4">
                        <button class="form-control bg-success text-white"  wire:click="switchcase">Press</button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control justify-content-center" wire:model="result" >
                    </div>>
                </div>
            </div>
        </div>
    </div>
</div>

</div>