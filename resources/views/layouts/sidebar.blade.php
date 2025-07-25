<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="/dashboard/{{ Auth::user()->role }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/alfaprima_ico.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/dashboard/{{ Auth::user()->role }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/alfaprima_ico.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/alfaprima_text.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span>@lang('translation.dashboards')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-analytics" class="nav-link">@lang('translation.analytics')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crm" class="nav-link">@lang('translation.crm')</a>
                            </li>
                            <li class="nav-item">
                                <a href="index" class="nav-link">@lang('translation.ecommerce')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crypto" class="nav-link">@lang('translation.crypto')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-projects" class="nav-link">@lang('translation.projects')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-nft" class="nav-link"> @lang('translation.nft')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-job" class="nav-link">@lang('translation.job')</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu --> --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/dashboard/{{ Auth::user()->role }}">
                        <i class=" ri-dashboard-2-line"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/course">
                        <i class=" ri-book-2-line"></i> <span data-key="t-dashboard">Mata Kuliah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/assignment">
                        <i class=" ri-task-line"></i> <span data-key="t-dashboard">Tugas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/account-approval">
                        <i class=" ri-numbers-line"></i> <span data-key="t-dashboard">Nilai</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
