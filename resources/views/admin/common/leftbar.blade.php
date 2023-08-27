<div class="iq-sidebar  rtl-iq-sidebar sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{route('index')}}" class="header-logo">
            <img src="{{ asset('admin/images/logo.png') }}" class="img-fluid rounded-normal light-logo"
                alt="logo">
            <img src="{{ asset('admin/images/logo-white.png') }}" class="img-fluid rounded-normal darkmode-logo"
                alt="logo">
        </a>
        <div class="iq-menu-bt-sidebar">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <!-- LEFT -->
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                {{-- <li class=" ">
                    <a href="#Dashboards" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="las la-home"></i><span>Dashboards</span>
                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                    </a>
                    <ul id="Dashboards" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class=" ">
                            <a href="index.html">
                                <i class="lab la-blogger-b"></i><span>Dashboard 1</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="dashboard-2.html">
                                <i class="las la-share-alt"></i><span>Dashboard 2</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="dashboard-3.html">
                                <i class="las la-icons"></i><span>Dashboard 3</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                @if(Auth::user()->user_type == 1)
                    <li class="">
                        <a href="{{route('admins.index')}}">
                            <i class="fa fa-users"></i><span>Admins</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('employee.index')}}">
                            <i class="fa fa-users"></i><span>Employees</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('customer.index')}}">
                            <i class="fa fa-users"></i><span>Customers</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('salary.index')}}">
                            <i class="fa fa-users"></i><span>Salary</span>
                        </a>
                    </li>
                @elseif(Auth::user()->user_type == 2)
                    <li class="">
                        <a href="{{route('customer.index')}}">
                            <i class="fa fa-users"></i><span>Customers</span>
                        </a>
                    </li>
                @endif
                <li class="">
                    <a href="{{route('appointment.index')}}">
                        <i class="fa fa-calendar"></i><span>Appointment</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div id="sidebar-bottom" class="position-relative sidebar-bottom">
            <div class="card bg-primary rounded">
                <div class="card-body">
                    <div class="sidebarbottom-content">
                        <div class="image"><img src="{{ asset('admin/images/layouts/side-bkg.png') }}"
                                class="img-fluid" alt="side-bkg"></div>
                        <h5 class="mb-3 text-white mt-3">Did you Know ?</h5>
                        <p class="mb-0 text-white">You can add additional user in your Account\'s Settings</p>
                        <button type="button" class="btn bg-light  mt-3"><i class="fas fa-plus-square"></i>
                            New Program</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3"></div>
    </div>
</div>