<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Master</div>
                    <a class="nav-link" href="<?= base_url('master/store'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                        Master Store
                    </a>
                    <a class="nav-link" href="<?= base_url('master/customer'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                        Master Customer
                    </a>
                    <a class="nav-link" href="<?= base_url('master/supplier'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                        Master Supplier
                    </a>
                    <a class="nav-link" href="<?= base_url('master/category_products'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-tag"></i></div>
                        Master Categories
                    </a>
                    <a class="nav-link" href="<?= base_url('master/products'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                        Master Products
                    </a>
                    <a class="nav-link" href="<?= base_url('master/unit'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-weight-hanging"></i></i></div>
                        Master Unit
                    </a>
                    <div class="sb-sidenav-menu-heading">Transaction</div>
                    <a class="nav-link" href="<?= base_url('transaction/price_products'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                        Price Product
                    </a>
                    <a class="nav-link" href="<?= base_url('transaction/stock'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                        Stock Product
                    </a>
                    <a class="nav-link" href="<?= base_url('transaction/order'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                        Order
                    </a>
                    <div class="sb-sidenav-menu-heading">Report</div>
                    <a class="nav-link" href="<?= base_url('report/index_print_pdf'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-pdf"></i></div>
                        Print Order
                    </a>
                    <div class="sb-sidenav-menu-heading">Logout</div>
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                        <div class="sb-nav-link-icon"><i class="fas fa-power-off"></i></div>
                        Logout
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= user()->username; ?>
            </div>
        </nav>
    </div>