<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 ps ps--active-y" id="sidenav-main" data-color="primary">
        <div class="sidenav-header">
            <i class="fa fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{url('dashboard')}}">
                <img src="{{asset('assets/img/logos/google.svg')}}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-2 h6 font-weight-bold text-uppercase">Welcome Admin</span>
            </a>
        </div>
        <hr class="horizontal mt-0">
        <div class="collapse navbar-collapse  w-auto h-auto h-100" id="sidenav-collapse-main">
            <ul class="navbar-nav">
<!--                 <li class="nav-item {{ (Request::is('dashboard') || Request::is('dashboard/*') ? 'active open' : '') }}">
                    <a class="nav-link {{ (Request::is('dashboard') || Request::is('dashboard/*') ? 'active' : '') }}" href="{{url('dashboard')}}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-shop text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li> -->
<!--                 <li class="nav-item {{ (Request::is('order') || Request::is('order/*') ? 'active open' : '') }}">
                    <a class="nav-link {{ (Request::is('order') || Request::is('order/*') ? 'active' : '') }}" href="{{url('order')}}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-basket text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Orders</span>
                    </a>
                </li>
                <li class="nav-item {{ (Request::is('status-screen') ? 'active open' : '') }}">
                    <a class="nav-link {{ (Request::is('status-screen') ? 'active' : '') }}" href="{{url('status-screen')}}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Order Status Screen</span>
                    </a>
                </li>
                <li class="nav-item {{ (Request::is('expense') || Request::is('expensecategory') ? 'active open' : '') }}">
                    <a data-bs-toggle="collapse" href="#expense" class="nav-link {{ (Request::is('expense') || Request::is('expensecategory') ? 'active' : '') }}" aria-controls="settings" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Expense</span>
                    </a>
                    <div class="collapse {{ (Request::is('expense') || Request::is('expensecategory') ? 'show' : '') }}" id="expense">
                        <ul class="nav ms-4">
                            <li class="nav-item {{ (Request::url()==url('expense') ? 'active' : '') }}">
                                <a class="nav-link" href="{{url('/expense')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> E </span>
                                    <span class="sidenav-normal side-bar-inner"> Expense List</span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::url()==url('expensecategory') ? 'active' : '') }}">
                                <a class="nav-link" href="{{url('/expensecategory')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> E </span>
                                    <span class="sidenav-normal side-bar-inner"> Expense Category</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li class="nav-item {{ (Request::url()==url('customer') ? 'active open' : '') }}">
                    <a class="nav-link {{ (Request::url()==url('customer') ? 'active' : '') }}" href="{{url('/customer')}}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-pink text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Mark Sheet</span>
                    </a>
                </li>

                <li class="nav-item {{ (Request::url()==url('report-card') ? 'active open' : '') }}">
                    <a class="nav-link {{ (Request::url()==url('report-card') ? 'active' : '') }}" href="{{url('report-card')}}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-collection text-pink text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Report Card </span>
                    </a>
                </li>

<!--                 <li class="nav-item {{ (Request::is('payments') || Request::is('payments/*') ? 'active open' : '') }}">
                    <a class="nav-link {{ (Request::is('payments') || Request::is('payments/*') ? 'active open' : '') }}" href="{{url('/payments')}}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-money-coins text-pink text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Payments</span>
                    </a>
                </li>
                <li class="nav-item {{ (Request::is('service') || Request::is('service/*') ? 'active open' : '') }}">
                    <a data-bs-toggle="collapse" href="#services" class="nav-link {{ (Request::is('service') || Request::is('service/*') ? 'active' : '') }}" aria-controls="settings" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-tag text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Services</span>
                    </a>
                    <div class="collapse {{ (Request::is('service') || Request::is('service/*') ? 'show' : '') }}" id="services">
                        <ul class="nav ms-4">
                            <li class="nav-item {{ (Request::is('service') || Request::is('service/add') ? 'active' : '') }}">
                                <a class="nav-link" href="{{url('service')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> S </span>
                                    <span class="sidenav-normal side-bar-inner"> Service List </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::url()==url('service/type') ? 'active' : '') }}">
                                <a class="nav-link " href="{{url('service/type')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> S </span>
                                    <span class="sidenav-normal side-bar-inner"> Service Type</span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::url()==url('service/addon') ? 'active' : '') }}">
                                <a class="nav-link" href="{{url('service/addon')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> A </span>
                                    <span class="sidenav-normal side-bar-inner"> Addons </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ (Request::is('warehouse') || Request::is('warehouse/*') ? 'active open' : '') }}">
                    <a data-bs-toggle="collapse" href="#warehouse" class="nav-link {{ (Request::is('warehouse') || Request::is('warehouse/*') ? 'active' : '') }}" aria-controls="settings" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-cart text-purple text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Warehouse</span>
                    </a>
                    <div class="collapse {{ (Request::is('warehouse') || Request::is('warehouse/*') ? 'show' : '') }}" id="warehouse">
                        <ul class="nav ms-4">
                            <li class="nav-item {{ (Request::is('warehouse/stock') || Request::is('warehouse/stock/*') ? 'active' : '') }}">
                                <a class="nav-link " href="{{url('warehouse/stock')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> S </span>
                                    <span class="sidenav-normal side-bar-inner"> Stock Entries </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::url()==url('warehouse/purchase') ? 'active' : '') }}">
                                <a class="nav-link " href="{{url('warehouse/purchase')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> P </span>
                                    <span class="sidenav-normal side-bar-inner"> Purchase </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::url()==url('warehouse/product') ? 'active' : '') }}">
                                <a class="nav-link " href="{{url('warehouse/product')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> P </span>
                                    <span class="sidenav-normal side-bar-inner"> Products </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{(Request::is('report/*') ? 'active open' : '')}}">
                    <a data-bs-toggle="collapse" href="#tasks" class="nav-link {{(Request::is('report/*') ? 'active' : '')}}" aria-controls="tasks" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-chart-bar-32 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Reports</span>
                    </a>
                    <div class="collapse {{(Request::is('report/*') ? 'show' : '')}}" id="tasks">
                        <ul class="nav ms-4">
                            <li class="nav-item {{ (Request::url()==url('report/daily') ? 'active' : '') }}">
                                <a class="nav-link " href="{{url('report/daily')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> D </span>
                                    <span class="sidenav-normal side-bar-inner"> Daily Report </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::url()==url('report/order') ? 'active' : '') }}">
                                <a class="nav-link " href="{{url('report/order')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> O </span>
                                    <span class="sidenav-normal side-bar-inner"> Order Report </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::url()==url('report/sales') ? 'active' : '') }}">
                                <a class="nav-link " href="{{url('report/sales')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> S </span>
                                    <span class="sidenav-normal side-bar-inner"> Sales Report </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::url()==url('report/expense') ? 'active' : '') }}">
                                <a class="nav-link" href="{{url('report/expense')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> E </span>
                                    <span class="sidenav-normal side-bar-inner"> Expense Report </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::url()==url('report/purchase') ? 'active' : '') }}">
                                <a class="nav-link " href="{{url('report/purchase')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> P </span>
                                    <span class="sidenav-normal side-bar-inner"> Purchase Report </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::url()==url('report/stock') ? 'active' : '') }}">
                                <a class="nav-link " href="{{url('report/stock')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> S </span>
                                    <span class="sidenav-normal side-bar-inner"> Stock Report </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::url()==url('report/tax') ? 'active' : '') }}">
                                <a class="nav-link " href="{{url('report/tax')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> T </span>
                                    <span class="sidenav-normal side-bar-inner"> Tax Report </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{(Request::is('tool/*') ? 'active open' : '')}}">
                    <a data-bs-toggle="collapse" href="#settings" class="nav-link {{(Request::is('tool/*') ? 'active' : '')}}" aria-controls="settings" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-settings-gear-65 text-orange text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Tools</span>
                    </a>
                    <div class="collapse {{(Request::is('tool/*') ? 'show' : '')}}" id="settings">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="tools-branch.php">
                                    <span class="sidenav-mini-icon side-bar-inner"> B </span>
                                    <span class="sidenav-normal side-bar-inner"> Branch Management </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="tools-supplier.php">
                                    <span class="sidenav-mini-icon side-bar-inner"> S </span>
                                    <span class="sidenav-normal side-bar-inner"> Supplier Management </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="tools-staff.php">
                                    <span class="sidenav-mini-icon side-bar-inner"> S </span>
                                    <span class="sidenav-normal side-bar-inner"> Staff Management </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="tools-file.php">
                                    <span class="sidenav-mini-icon side-bar-inner"> F </span>
                                    <span class="sidenav-normal side-bar-inner"> File Manager </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::url()==url('tool/master') ? 'active' : '') }}">
                                <a class="nav-link " href="{{url('tool/master')}}">
                                    <span class="sidenav-mini-icon side-bar-inner"> M </span>
                                    <span class="sidenav-normal side-bar-inner"> Master Settings </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>  --> 
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/logout')}}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-button-power text-secondary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <hr class="horizontal dark mt-2">
    </aside>