<div>
    
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Master Settings</h5>
        </div>
        
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-3">
                    <form class="row g-3 align-items-center" enctype="multipart/form-data">
                        <div><span class="text-sm text-uppercase">Application Details</span></div>
                        <hr>
                        <div class="col-md-4">
                            <label class="form-label">Application Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="application_name" autofocus class="form-control" placeholder="Enter Application Name">
                            @error('application_name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Application Title</label>
                            <input type="text" wire:model="application_title" class="form-control" placeholder="Enter Application Title">
                            @error('application_title') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">App Logo</label>
                            <input type="file" wire:model="app_logo" class="form-control">
                            @error('app_logo') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Favicon</label>
                            <input type="file" wire:model="favicon" class="form-control">
                            @error('favicon') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="number" wire:model="mobile" class="form-control" placeholder="Enter Phone Number">
                            @error('mobile') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email ID <span class="text-danger">*</span></label>
                            <input type="email" wire:model="email_id" class="form-control" placeholder="Enter Email ID">
                            @error('email_id') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <hr>
                        <div><span class="text-sm text-uppercase">Payroll Details</span></div>
                        <hr>
                        <div class="col-md-3">
                            <label class="form-label">Currency Symbol</label>
                            <input type="text" wire:model="currency_symbol" class="form-control" placeholder="Enter Currency Symbol">
                            @error('currency_symbol') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tax Percentage</label>
                            <input type="text" wire:model="tax_percentage" class="form-control" placeholder="Enter Tax Rate">
                            @error('tax_percentage') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Payrun Period</label>
                            <input type="text" wire:model="payrun_period" class="form-control" value="Monthly" readonly>
                            @error('payrun_period') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Total Paid Leave</label>
                            <input type="number" wire:model="total_paid_leave" class="form-control" placeholder="Enter Number of Paid Leave">
                            @error('total_paid_leave') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <hr>
                        <div><span class="text-sm text-uppercase">Firm Address</span></div>
                        <hr>
                        <div class="col-md-3">
                            <label class="form-label">Country</label>
                            <input type="text" wire:model="country" class="form-control" placeholder="Enter Country">
                            @error('country') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">State</label>
                            <input type="text" wire:model="state" class="form-control" placeholder="Enter State">
                            @error('state') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">District</label>
                            <input type="text" wire:model="district" class="form-control" placeholder="Enter District">
                            @error('district') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" wire:model="pincode" class="form-control" placeholder="Enter Zip Code">
                            @error('pincode') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="inputAddress" class="form-label">Address</label>
                            <textarea class="form-control" wire:model="address" placeholder="Enter Address"></textarea>
                            @error('address') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
    
                        <hr>
    
                        <div class="d-flex align-items-center justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary ms-4" wire:click.prevent="update">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
