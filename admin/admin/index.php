<?php
session_start();

require_once '../conn.php';

if($_SESSION['loginData']['role'] != 'admin'){
    header("Location: ../../auth/login_admin.php");
}


$kategori = mysqli_num_rows(mysqli_query($conn ,"SELECT * FROM kategori"));
$user = mysqli_num_rows(mysqli_query($conn ,"SELECT * FROM user"));
$komentar = mysqli_num_rows(mysqli_query($conn ,"SELECT * FROM diskusi_chat"));
$diskusi = mysqli_num_rows(mysqli_query($conn ,"SELECT * FROM diskusi"));

?>

<!doctype html>
<html lang="en">

<?php include "head.php"; ?>

<body>

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <?php include "sidebar.php"; ?>

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <?= $_SESSION['loginData']['nama'] ?> - <?= $_SESSION['loginData']['level'] ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="../logout.php"
                                            class="btn btn-outline-danger mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">

                <h3 class="mb-3">Dashboard</h3>
                <br><br>

                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                        <div class="alert text-white" style="background-color: green;">
                            <h3 class="text-white"><?= $kategori ?></h3>
                            <p>Jumlah Kategori</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                        <div class="alert text-white" style="background-color: red;">
                            <h3 class="text-white"><?= $user ?></h3>
                            <p>Jumlah Member Forum</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                        <div class="alert text-white" style="background-color: skyblue;">
                            <h3 class="text-white"><?= $komentar ?></h3>
                            <p>Jumlah Komentar Diskusi</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                        <div class="alert text-white" style="background-color: orange;">
                            <h3 class="text-white"><?= $diskusi ?></h3>
                            <p>Jumlah Judul Diskusi</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>