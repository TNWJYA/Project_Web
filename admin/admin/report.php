<?php
session_start();
include '../conn.php';

if($_SESSION['loginData']['role'] != 'admin'){
    header("Location: ../../auth/login_admin.php");
}

$report = mysqli_query($conn, "SELECT * FROM report");

?>

<!doctype html>
<html lang="en">

<?php include "head.php"; ?>

<style>
    td,
    th {
        min-width: 100px !important;
        max-width: 200px !important;
    }
</style>
<script>
    $(document).ready(function () {

        // Sembunyikan form tambah saat halaman dimuat
        $('#form-tambah').hide();
        $('#hidden').hide();

        // Tampilkan form tambah saat tombol Tambah Data diklik
        $('#show').click(function () {
            $('#form-tambah').fadeIn();
            $('#hidden').show();
            $('#show').hide();
        });

        // Sembunyikan form tambah saat tombol Tutup Form diklik
        $('#hidden').click(function () {
            $('#form-tambah').fadeOut();
            $('#hidden').hide();
            $('#show').show();
        });

    });
</script>

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

                <h3 class="mb-3">Data report</h3>


                <div class="row mt-3">

                    <div class="col d-flex align-items-stretch mt-3">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold mb-4">Data report</h5>
                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nomor</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Jenis Pelanggaran</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Alasan</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Aksi</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($report as $data) : ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0"><?= $i; ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"><?= $data['jenis_pelanggaran']; ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"><?= $data['alasan']; ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                        <br><br>
                                                        <a class="btn btn-danger"
                                                            href="komentar.php?id_komentar=<?= $data['id_report']; ?>">
                                                            Lihat Komentar
                                                        </a>
                                                    </h6>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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