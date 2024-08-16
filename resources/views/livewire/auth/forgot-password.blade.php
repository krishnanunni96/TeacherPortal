<div>
    
    <div class="page-header min-vh-100" style="background-image: url('assets/img/login-bg.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-7">
                        <div class="card border-0 mb-0">
                            <div class="card-header bg-transparent text-center">
                                <div class="d-flex align-items-center justify-content-center mt-2 mb-2">
                                    <img src="{{asset('assets/img/logo-ct.png')}}" class="login-logo">
                                    <h4 class="text-dark ms-3 mb-0 text-uppercase">Laundry Box</h4>
                                </div>
                            </div>
                            @if(session()->has('error'))
                                <span class="alert alert-color text-center" style="margin-left:10px; margin-right:10px; color:white">
                                    {{ session()->get('error') }}
                                </span>
                            @endif
                            <div class="card-body px-lg-5 pt-0">
                                <div class="text-muted mb-4">
                                    <center><h4>Password Reset</h4></center>
                                </div>
                                <div class="text-muted mb-4">
                                    <small>Enter your email address. We'll send you an email with your username and a link to reset your password.</small>
                                </div>
                                <form>
                                    <div class="mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter recovery email" wire:model="email">
                                        @error('email') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" wire:click.prevent="submit" class="btn btn-primary w-100 my-4 mb-4">Submit</button>
                                    </div>
                                    <div class="mb-2 position-relative text-center">
                                        <p class="text-sm fw-500 mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                            Powered by <a href="#" class="text-dark fw-600" target="_blank">Chasing Pixels</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>