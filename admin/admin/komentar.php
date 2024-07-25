<?php
session_start();
include '../conn.php';

if($_SESSION['loginData']['role'] != 'admin'){
    header("Location: ../../auth/login_admin.php");
}

$id_report = $_GET['id_komentar'];

// $report = mysqli_fetch_assoc(mysqli_query($conn ,"SELECT * FROM report WHERE id_report = $id_report"));
$report = query("SELECT * FROM report WHERE id_report = $id_report");

$id_komentar = $report['id_diskusi_chat'];

$cek = query("SELECT * FROM diskusi_chat WHERE id_diskusi_chat = $id_komentar");

$id_diskusi = $cek['id_diskusi'];
$diskusi = query("SELECT * FROM diskusi WHERE id_diskusi = $id_diskusi");

// Hapus
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM diskusi_chat WHERE id_diskusi_chat = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: report.php");
    } else {
        echo "Data tidak berhasil dihapus";
    }
}


$komentar = mysqli_query($conn, "SELECT * FROM diskusi_chat");


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

                <h3 class="mb-3"> Diskusi</h3>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Judul Diskusi</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0"><?= $diskusi['judul_diskusi']; ?></h6>
                                </th>
                            </tr>
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Kategori</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">
                                        <?php $id_kategori = $diskusi['id_kategori']; ?>
                                        <?php 
                                        $kategori = query("SELECT * FROM kategori WHERE id_kategori = $id_kategori"); 
                                        ?>
                                        <?= $kategori['nama_kategori']; ?>
                                    </h6>
                                </th>
                            </tr>
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Pembuat Diskusi</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">
                                        <?php $id_user = $diskusi['id_creator']; ?>
                                        <?php $cek_user2 = query("SELECT * FROM user WHERE id_user = $id_user"); ?>
                                        <?= $cek_user2['nama']; ?>
                                    </h6>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="row mt-3">
                    <div class="col d-flex align-items-stretch mt-3">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold mb-4">Data Komentar</h5>
                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nomor</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Member</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Isi Komentar</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Aksi</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($komentar as $data) : ?>
                                            <tr
                                                class="<?= $id_komentar == $data['id_diskusi_chat'] ? 'bg-warning' : $id_komentar.'|'.$data['id_diskusi_chat']; ?>">
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0"><?= $i; ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1">
                                                        <?php $id_user_komentar = $data['id_user']; ?>
                                                        <?php $cek_usr = query("SELECT * FROM user WHERE id_user = $id_user_komentar"); ?>
                                                        <?= $cek_usr['nama']; ?>
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"><?= $data['content']; ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                        <br><br>
                                                        <a class="btn btn-danger"
                                                            href="komentar.php?id=<?= $data['id_diskusi_chat']; ?>&id_komentar=<?= $id_report ?>">
                                                            Hapus
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
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>