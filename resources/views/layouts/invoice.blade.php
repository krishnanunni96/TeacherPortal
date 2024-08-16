<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        Xfortech | Laundry POS
    </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <meta name="keywords" content="Xfortech Laundry POS, Laundry POS for software companies, best Laundry POS, Project management Script, Laravel Scrit , Laravel POS, Service Management POS System">
    <meta name="description" content="Xfortech | Laundry POS is a simple and powerful POS system for laundry service owners to keep track of their customers, orders, sales, expense,etc... The complete application is build in laravel livewire for small and large scale laundry service providers to manage their daily sales, expense, customers,etc...">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />

    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.min28b5.css?v=2.0.0') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

    

@livewireStyles

</head>

<body class="g-sidenav-show">

    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    <main class="main-content position-relative border-radius-lg ">

        <div class="container-fluid py-2">
            {{$slot}}
        </div>
    </main>
@livewireScripts
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/button.js') }}"></script>
</body>
<script type="text/javascript">
    $(document).ready(function(){
    window.print();
    });
</script> 
</html>