<div>

<div class="row">
    <div class="col-lg-12">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="card-body p-3">
                        <div class="row align-items-center px-2">
                            <div class="col-8">
                                <div class="numbers py-2">
                                    <p class="text-sm mb-3 text-uppercase">Pending Orders</p>
                                    <h5 class="font-weight-bolder">{{$pending}}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-secondary text-center rounded-circle">
                                    <i class="ni ni-basket text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="card-body p-3">
                        <div class="row align-items-center px-2">
                            <div class="col-8">
                                <div class="numbers py-2">
                                    <p class="text-sm mb-3 text-uppercase">Processing Orders</p>
                                    <h5 class="font-weight-bolder">{{$processing}}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-warning text-center rounded-circle">
                                    <i class="ni ni-atom text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="card-body p-3">
                        <div class="row align-items-center px-2">
                            <div class="col-8">
                                <div class="numbers py-2">
                                    <p class="text-sm mb-3 text-uppercase">Ready to Deliver</p>
                                    <h5 class="font-weight-bolder">{{$ready_to_deliver}}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-success text-center rounded-circle">
                                    <i class="ni ni-like-2 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="card-body p-3">
                        <div class="row align-items-center px-2">
                            <div class="col-8">
                                <div class="numbers py-2">
                                    <p class="text-sm mb-3 text-uppercase">Delivered Orders</p>
                                    <h5 class="font-weight-bolder">{{$delivered}}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-primary text-center rounded-circle">
                                    <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header pb-4 pt-3">
                <div class="row g-2 align-items-center">
                    <div class="col-4">
                        <h5 class="pb-0 fw-500">Today's Delivery</h5>
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" placeholder="Search Here" wire:model="search">
                    </div>
                    <div class="col-3">
                        <select class="form-select" wire:model="filter">
                            <option class="select-box" value="">All Orders</option>
                            <option class="select-box" value="1">Pending</option>
                            <option class="select-box" value="2">Processing</option>
                            <option class="select-box" value="3">Ready to Deliver</option>
                            <option class="select-box" value="4">Delivered</option>
                            <option class="select-box" value="5">Returned</option>
                            <option class="select-box" value="6">Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row g-2 align-items-center">
                    @foreach ($orders as $item)
                        <div class="col-lg-4 col-12">
                            <div class="today-task-{{getStatus($item->status)}}">
                                <div class="d-flex justify-content-between mb-2">
                                    <a href="{{url('order/preview/'.$item->id)}}" type="button">
                                        <span class="fw-600 ms-2 text-dark text-xs mb-0">{{$item->customer->name}}</span>
                                    </a>
                                    <a href="{{url('order/preview/'.$item->id)}}" type="button">
                                        <span class="fw-600 text-dark text-xs me-2">{{$item->order_no}}</span>
                                    </a>
                                </div>
                                <div class="pt-1 mb-0">
                                    @foreach ($order_details as $data)
                                        @if ($data->service->icon=="Female")                
                                            <a class="avatar avatar-sm ms-2 p-1 bg-light">
                                                <img src="{{asset('assets/img/service-icons/woman-clothes.png')}}">
                                            </a>
                                        @elseif ($data->service->icon=="Baby Cloths")
                                            <a class="avatar avatar-sm ms-2 p-1 bg-light">
                                                <img src="{{asset('assets/img/service-icons/baby-clothes.png')}}">
                                            </a>
                                        @endif
                                    @endforeach                        
                                </div>
                            </div>
                        </div>
                    @endforeach                    
                </div>
                {{-- @livewire('calender') --}}
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <h5 class="pb-4 fw-500">Overview</h5>
            </div>
            <div class="card-body pt-0 pb-0">
                <div class="row">
                    <div class="col-12 text-start mb-4">
                        <div wire:ignore class="chart">
                            <canvas id="doughnut-chart" class="chart-canvas" height="300px"></canvas>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <span class="badge badge-md badge-dot ms-4 text-start">
                                <i class="bg-secondary"></i>
                                <span class="text-dark text-xs">Pending</span>
                            </span>
                            <span class="badge badge-md badge-dot me-4 text-start">
                                <i class="bg-warning"></i>
                                <span class="text-dark text-xs">Processing</span>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="badge badge-md badge-dot ms-4 text-start">
                                <i class="bg-success"></i>
                                <span class="text-dark text-xs">Ready to deliver</span>
                            </span>
                            <span class="badge badge-md badge-dot me-4 text-start">
                                <i class="bg-primary"></i>
                                <span class="text-dark text-xs">Delivered</span>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="badge badge-md badge-dot ms-4 text-start">
                                <i class="bg-danger"></i>
                                <span class="text-dark text-xs">Returned</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="{{$json_data}}" id="chart"> 
<script>
    // Doughnut chart
    $( document ).ready(function() {

    var ctx3 = document.getElementById("doughnut-chart").getContext("2d");
    var data = JSON.parse(document.getElementById("chart").value);
    
    new Chart(ctx3, {
        type: "doughnut",
        data: {
            labels: ['Pending', 'Processing', 'Ready to Deliver', 'Delivered', 'Returned'],
            datasets: [{
                label: "Projects",
                weight: 9,
                cutout: 60,
                tension: 0.9,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: ['#8392ab', '#ecb15d', '#27bc7c', '#5055a2', '#eb7966'],
                data: data[0],
                fill: false
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        display: false,
                    }
                },
            },
        },
    });
});


</script>
</div>