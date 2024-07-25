<?php
session_start();
include '../conn.php';

if($_SESSION['loginData']['role'] != 'admin'){
    header("Location: ../../auth/login_admin.php");
}
if ($_SESSION['loginData']['level'] != 'Admin Master'){
    header("Location: ../../auth/login_admin.php");
}

// Hapus
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM user WHERE id_user = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: user.php");
    } else {
        echo "Data tidak berhasil dihapus";
    }
}

$user = mysqli_query($conn, "SELECT * FROM user");

// function upload_foto()
// {
//     $namaFile = $_FILES['file']['name'];
//     $ukuranFile = $_FILES['file']['size'];
//     $error = $_FILES['file']['error'];
//     $tmpName = $_FILES['file']['tmp_name'];


//     $ekstensifile = explode('.', $namaFile);
//     $ekstensifile = strtolower(end($ekstensifile));

//     // generate nama file baru
//     $namaFileBaru = uniqid();
//     $namaFileBaru .= '.';
//     $namaFileBaru .= $ekstensifile;
//     move_uploaded_file($tmpName, '../foto/' . $namaFileBaru);

//     return $namaFileBaru;
// }

function tambah($data)
{
    global $conn;

    $username = htmlspecialchars($data["nama"]);
    $password = htmlspecialchars($data["password"]);
    $email = htmlspecialchars($data["email"]);
    $nama = htmlspecialchars($data["nama"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $foto = $data['foto'];

    // Cek apakah id sudah ada di database
    $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
    if (mysqli_fetch_assoc($result)) {
        // Jika email sudah ada, berikan pesan error atau tindakan lainnya
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Email Sudah Terdaftar!',
                    html: 'Mohon gunakan email yang lain..',
                    timer: 4000,
                    timerProgressBar: true
                });
            </script>";
    }else{
        mysqli_query($conn, "INSERT INTO user VALUES(NULL, '$email', '$password', '$nama', '$no_hp', '$foto')");
        return mysqli_affected_rows($conn);
    }

}

?>

<!doctype html>
<html lang="en">

<?php include "head.php"; ?>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>

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
    <?php
    if (isset($_POST["add"])) {

        if (tambah($_POST) > 0) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    title: 'Berhasil Menambah Data',
                    timer: 3000,
                    showConfirmButton: false
                });
                    setTimeout(function(){
                    window.location.href = 'user.php';
                }, 2000);
                </script>";
        } else {
            echo mysqli_error($conn);
        }
    };
    ?>
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

                <h3 class="mb-3">Data user</h3>
                <button class="btn btn-info" id="show"><i class="ti ti-plus"></i> Tambah Data</button>
                <button class="btn btn-danger" id="hidden"><i class="ti ti-x"></i> Batal</button>

                <div class="row mt-3">
                    <div class="card pt-3" id="form-tambah">
                        <div class="card-header">
                            <i class="ti ti-info-circle me-2"></i> Insert Data
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Alamat Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="no_hp" class="form-label">Nomor Handphone</label>
                                            <input type="number" class="form-control" name="no_hp" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="file" class="form-label">Upload Foto URL</label>
                                            <input type="text" class="form-control" name="foto" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="add" class="btn btn-primary w-100">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col d-flex align-items-stretch mt-3">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold mb-4">Data user</h5>
                                <div class="table-responsive">
                                    <table id="myTable" class="table text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nomor</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Email</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nama Lengkap</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nomor Handphone</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Foto</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Aksi</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($user as $data) : ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0"><?= $i; ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"><?= $data['email']; ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"><?= $data['nama']; ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"><?= $data['no_hp']; ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <?php if($data['img'] != NULL): ?>
                                                    <h6 class="fw-semibold mb-1">
                                                        <a href="javascript:void(0);"
                                                            onclick="openImageInNewTab('<?= $data['img']; ?>')">
                                                            <?= substr($data['img'], 0, 20); ?>...
                                                        </a>
                                                    </h6>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                        <a class="btn btn-warning"
                                                            href="edit-user.php?id=<?= $data['id_user']; ?>">
                                                            <i class="ti ti-edit-circle text-white"></i>
                                                        </a>
                                                        <br><br>
                                                        <a class="btn btn-danger"
                                                            href="user.php?id=<?= $data['id_user']; ?>">
                                                            <i class="ti ti-trash bg-danger"></i>
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

    <!-- datatable -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        function openImageInNewTab(imageUrl) {
            var win = window.open();
            win.document.write('<img src="' + imageUrl + '">');
        }
    </script>

</body>

</html>