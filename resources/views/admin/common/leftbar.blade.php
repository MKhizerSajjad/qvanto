<div class="iq-sidebar  rtl-iq-sidebar sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{route('index')}}" class="header-logo">
            <img src="{{ asset('admin/images/logo.png') }}" class="img-fluid rounded-normal light-logo"
                alt="logo">
            {{-- <img src="{{ asset('admin/images/logo.png') }}" class="img-fluid rounded-normal darkmode-logo"
                alt="logo"> --}}
        </a>
        <div class="iq-menu-bt-sidebar">
            <i class="fa fa-bars wrapper-menu"></i>
        </div>
    </div>
    <!-- LEFT -->
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="{{ request()->routeIs(['home', 'index', 'dashboard']) ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}">
                        <i class="fa fa-chart-pie"></i><span>Dashboard</span>
                    </a>
                </li>
                @if(Auth::user()->user_type == 1)
                    <li class="{{ request()->is('vendor*') ? 'active' : '' }}">
                        <a href="{{route('vendor.index')}}">
                            <i class="fa fa-users"></i><span>Vendors</span>
                        </a>
                    </li>
                @endif
                <li class="{{ request()->is('lead*') ? 'active' : '' }}">
                    <a href="{{route('lead.index')}}">
                        <i class="fa fa-headset"></i><span>Leads</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
