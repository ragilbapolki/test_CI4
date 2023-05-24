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
                    <a class="nav-link" href="<?= base_url('administrator/setting_user'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Setting User
                    </a>
                    <div class="sb-sidenav-menu-heading">Master</div>
                    <a class="nav-link" href="<?= base_url('master/division'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                        Master Division
                    </a>
                    <a class="nav-link" href="<?= base_url('master/position'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                        Master Position
                    </a>
                    <a class="nav-link" href="<?= base_url('master/branch'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                        Master Branch
                    </a>
                    <a class="nav-link" href="<?= base_url('master/employee'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-tag"></i></div>
                        Master Employee
                    </a>
                    <a class="nav-link" href="<?= base_url('master/category'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                        Master Categories
                    </a>
                    <a class="nav-link" href="<?= base_url('master/stage'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                        Master STAGE
                    </a>
                    <div class="sb-sidenav-menu-heading">Transaction</div>
                    <a class="nav-link" href="<?= base_url('transaction/carp'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                        CARP
                    </a>
                    <a class="nav-link" href="<?= base_url('transaction/carp_pic'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                        Your CARP
                    </a>
                    <a class="nav-link" href="<?= base_url('transaction/carp_approval'); ?>">
                    <i class=""></i>
                        <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                        Approval CARP
                    </a>
                    <div class="sb-sidenav-menu-heading">Report</div>
                    <a class="nav-link" href="<?= base_url('report/index_print_pdf'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-pdf"></i></div>
                        Print PDF
                    </a>
                    <a class="nav-link" href="<?= base_url('report/index_print_excel'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-pdf"></i></div>
                        Print Excel
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