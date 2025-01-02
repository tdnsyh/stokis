<aside class="left-sidebar no-print">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/dashboard" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="Logo" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link  @if (request()->is('dashboard*')) active @endif" href="/dashboard"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Stokis</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if (request()->is('stokis*')) active @endif" href="/stokis"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Data Stokis</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if (request()->is('penjualan*')) active @endif" href="/penjualan"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-shopping-cart"></i>
                        </span>
                        <span class="hide-menu">Penjualan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if (request()->is('laporan*')) active @endif" href="/laporan"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-book"></i>
                        </span>
                        <span class="hide-menu">Laporan</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Master Data</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if (request()->is('kokab*')) active @endif" href="/kokab"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-map"></i>
                        </span>
                        <span class="hide-menu">Kota</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if (request()->is('kecamatan*')) active @endif" href="/kecamatan"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-location"></i>
                        </span>
                        <span class="hide-menu">Kecamatan</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
