<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="/dashboard/<?php echo e(Auth::user()->role); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/alfaprima_ico.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/dashboard/<?php echo e(Auth::user()->role); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/alfaprima_ico.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/alfaprima_text.png')); ?>" alt="" height="17">
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
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/dashboard/<?php echo e(Auth::user()->role); ?>">
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
<?php /**PATH /home/reset/LEARN/sistem-akademik/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>