<!-- Main Sidebar Container -->
@php($routeIndex = request()->route()->getName())
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Hệ thống chất lượng</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link @if(in_array($routeIndex, [DOCUMENT_INDEX, DOCUMENT_CREATE, DOCUMENT_SHOW])) active @endif">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Quản lý hồ sơ
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route(DOCUMENT_INDEX) }}" class="nav-link @if(in_array($routeIndex, [DOCUMENT_INDEX])) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách hồ sơ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route(DOCUMENT_CREATE) }}" class="nav-link @if(in_array($routeIndex, [DOCUMENT_CREATE])) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm hồ sơ</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route(TRANSFER_FILE) }}" class="nav-link @if($routeIndex == TRANSFER_FILE)) active @endif">
                        <i class="nav-icon far fa-file"></i>
                        <p>
                            Phiếu chuyển giấy
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>