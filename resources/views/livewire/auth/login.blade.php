<div>
    
    <div class="page-header min-vh-100" style="background-image: url('assets/img/login-bg.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-7">
                        <div class="card border-0 mb-0">
                            <div class="card-header bg-transparent text-center">
                                <div class="d-flex align-items-center justify-content-center mt-2 mb-2">
                                    <img src="assets/img/logo-ct.png" class="login-logo">
                                    <h4 class="text-dark ms-3 mb-0 text-uppercase">Teacher Portal</h4>
                                </div>
                            </div>
                            @if(session()->has('error'))
                                <span class="alert alert-color text-center" style="margin-left:10px; margin-right:10px; color:white">
                                    {{ session()->get('error') }}
                                </span>
                            @endif
                            <div class="card-body px-lg-5 pt-0">
                                <div class="text-muted mb-4 text-center">
                                    <small>Login to Continue</small>
                                </div>
                                <form>
                                    <div class="mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" wire:model="email" autofocus>
                                        @error('email') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" wire:model="password">
                                        @error('password') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                    <!-- <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" wire:model="remember_me">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                        <a class="form-check-label" href="{{url('/forgot')}}" style="padding-left: 65px;" type="button">Forgot password</a>
                                    </div> -->
                                    <div class="text-center">
                                        <button type="submit" wire:click.prevent="checkLogin" class="btn btn-primary w-100 my-4 mb-4">Login</button>
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