<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-ct.png') }}">
    <title>
        Teacher Portal
    </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!--     <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script> -->

    <meta name="keywords" content="Teacher Portal is a simple and powerful system to manage every students marks and monitor them closely.">
    <meta name="description" content="Teacher Portal is a simple and powerful system to manage every students marks and monitor them closely.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="{{asset('assets/select2/select2.min.css')}}"> -->

    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />

    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.min28b5.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/toastr/toastr.css') }}" rel="stylesheet" />
    <!-- <link href="{{ asset('assets/css/jkanban.css') }}" rel="stylesheet" /> -->
    <!-- <link href="{{ asset('assets/dragula/dragula.min.css') }}" rel="stylesheet" /> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
    

@livewireStyles

<!--     <script>
        (function(a, s, y, n, c, h, i, d, e) {
            s.className += ' ' + y;
            h.start = 1 * new Date();
            h.end = i = function() {
                s.className = s.className.replace(RegExp(' ?' + y), '')
            };
            (a[n] = a[n] || []).hide = h;
            setTimeout(function() {
                i();
                h.end = null
            }, c);
            h.timeout = c;
        });(window, document.documentElement, 'dataLayer', 4000, {
            'GTM-K9BGS8K': true
        });

    </script>

    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'assets/js/analytics.js', 'ga');
        ga('create', 'UA-46172202-22', 'auto', {
            allowLinker: true
        });
        ga('set', 'anonymizeIp', true);
        ga('require', 'GTM-K9BGS8K');
        ga('require', 'displayfeatures');
        ga('require', 'linker');
        ga('linker:autoLink', ["2checkout.com", "avangate.com"]);

    </script> -->

</head>

<body class="g-sidenav-show">

    <noscript><iframe src="https://www.googletagmanager.com/ns.php?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <div class="min-height-300 bg-primary position-absolute w-100"></div>

@include('component.sidebar')

    <main class="main-content position-relative border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
        <!-- When browser goes offline, it will notify using wire:offliine utility. It automatically hides when internet is connected-->
                    <div wire:offline class="bg-danger">
                        <span class="text-white">You are now offline..!</span>
                    </div>
<!--                 <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
                    <a href="javascript:;" class="nav-link p-0">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </div>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="ms-md-auto  navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center me-2">
                            <a href="{{url('order/add')}}" class="nav-link text-white font-weight-bold px-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add New Order" data-container="body" data-animation="true">
                                <i class="fa fa-plus-circle me-sm-1"></i>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center me-2">
                            <a href="{{url('service')}}" class="nav-link text-white font-weight-bold px-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Manage Services" data-container="body" data-animation="true">
                                <i class="fa fa-tag me-sm-1"></i>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center me-2">
                            <a href="{{url('customer')}}" class="nav-link text-white font-weight-bold px-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Manage Customers" data-container="body" data-animation="true">
                                <i class="fa fa-user me-2"></i>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <div class="dropdown">
                                <button class="btn btn-xs bg-white dropdown-toggle mb-0 text-primary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    English
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item text-xs" href="#">Arabic</a></li>
                                    <li><a class="dropdown-item text-xs" href="#">Chinese</a></li>
                                    <li><a class="dropdown-item text-xs" href="#">Hindi</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div> -->
            </div>
        </nav>

        <div class="container-fluid py-2">
            {{$slot}}
            <footer class="footer pt-3">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © <script src="{{ asset('assets/js/email-decode.js') }}"></script>
                                <script> document.write(new Date().getFullYear()) </script> |
                                Designed by
                                <a href="#" class="font-weight-bold ms-1 text-muted" target="_blank">Chasing Pixels</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item text-sm text-muted">
                                    Version: 1.0.0
                                </li>
                                <li class="nav-item px-2 text-sm text-muted">
                                    |
                                </li>
                                <li class="nav-item text-sm text-muted">
                                    DB: 1.0.1
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
@livewireScripts
@stack('scripts')

        {{-- <script src="https://unpkg.com/@popperjs/core@2"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/toastr/toastr.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <!-- <script src="{{ asset('assets/dragula/dragula.min.js') }}"></script> -->
        <!-- <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script> -->
        <!-- <script src="{{ asset('assets/js/plugins/dragula/dragula.min.js') }}"></script>  -->
        <!-- <script src="{{ asset('assets/js/plugins/jkanban/jkanban.js') }}"></script> -->

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

</script>

<!-- <script src="{{ asset('assets/js/plugins/dropzone.min.js') }}"></script> -->
<script src="{{ asset('assets/js/button.js') }}"></script>
<script src="{{ asset('assets/js/argon-dashboard.min.js') }}"></script>

<script>   
    document.addEventListener("wheel", function(event){
        if(document.activeElement.type === "number"){
            document.activeElement.blur();
        }
    });

    window.addEventListener('alert', event => { 
             toastr[event.detail.type](event.detail.message, 
             event.detail.title ?? ''), toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                }
            });
       Livewire.on('closemodal' ,() => {
            $('.modal').modal('hide')
       });

    window.addEventListener('swal:modal', event => { 
        swal({
        title: event.detail.message,
        text: event.detail.text,
        icon: event.detail.type,
        });
    });
  
    window.addEventListener('swal:confirm', event => { 
        swal({
        title: event.detail.message,
        text: event.detail.text,
        icon: event.detail.type,
        buttons: true,
        dangerMode: true, 
        })
        .then((willDelete) => { 
        if (willDelete) {   
            window.livewire.emit('remove'); 
        }
        });
    });
</script>
@include('component.notification');
</body>
</html>