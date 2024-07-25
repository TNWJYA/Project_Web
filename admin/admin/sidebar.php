<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-center">
            <?php
            $username = $_SESSION['loginData']['nama'];

            $nama_array = explode(" ", $username);
            $singkatan = "";
            foreach ($nama_array as $nama_bagian) {
                $singkatan .= strtoupper($nama_bagian[0]);
            }
            $singkatan;
            ?>
            <a href="" class="btn w-100 text-left text-dark p-3 text-decoration-none logo-img"
                style="background-color: lightgrey;">
                <span style="background-color:#EEEEEE;"
                    class="p-2 m-1 rounded-circle text-sm me-3"><?= $singkatan; ?></span>
                <?= $username; ?>
            </a>


            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Menu</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./index.php" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./kategori.php" aria-expanded="false">
                        <span>
                            <i class="ti ti-list-check"></i>
                        </span>
                        <span class="hide-menu">Data Kategori Diskusi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./report.php" aria-expanded="false">
                        <span>
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Data Report</span>
                    </a>
                </li>
                <?php if ($_SESSION['loginData']['level'] == 'Admin Master') : ?>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./user.php" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Data Member</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./admin.php" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Data Admin</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
            <br><br><br>
            <br><br><br>
            <br><br><br>
        </nav>

        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->