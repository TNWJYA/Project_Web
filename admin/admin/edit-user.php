<?php
session_start();
include '../conn.php';

if($_SESSION['loginData']['role'] != 'admin'){
    header("Location: ../../auth/login_admin.php");
}
if ($_SESSION['loginData']['level'] != 'Admin Master'){
    header("Location: ../../auth/login_admin.php");
}

$id = $_GET['id'];
$data = query("SELECT * FROM user WHERE id_user = $id");


function edit($data)
{
    global $conn;
    global $id;

    $username = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $nama = htmlspecialchars($data["nama"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $password_baru = htmlspecialchars($data["password"]);
    $img = htmlspecialchars($data["img"]);

    if (!empty($password_baru)) {
        mysqli_query($conn, "UPDATE user SET nama = '$username', email = '$email', nama = '$nama', no_hp = '$no_hp', img = '$img', password = '$password_baru' WHERE id_user = '$id'");
    } else {
        mysqli_query($conn, "UPDATE user SET nama = '$username', email = '$email', nama = '$nama', no_hp = '$no_hp', img = '$img' WHERE id_user = '$id'");
    }

    echo mysqli_error($conn);

    return mysqli_affected_rows($conn);
}

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

<body>
    <?php
    if (isset($_POST["add"])) {

        if (edit($_POST) > 0) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                toast: true,
                position: 'top-end',
                title: 'Berhasil Edit Data',
                timer: 1500,
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

                <h3 class="mb-3">Edit Data user</h3>

                <div class="row mt-3">
                    <div class="card pt-3" id="form-tambah">
                        <div class="card-header">
                            <i class="ti ti-info-circle me-2"></i> Edit Data
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $id; ?>" required>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama"
                                                value="<?= $data['nama']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 
                                    col-sm-12">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password Baru *Opsional</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 
                                    col-sm-12">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="<?= $data['email']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 
                                    col-sm-12">
                                        <div class="mb-3">
                                            <label for="no_hp" class="form-label">Nomor Handphone</label>
                                            <input type="number" class="form-control" name="no_hp"
                                                value="<?= $data['no_hp']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="file" class="form-label">Upload Foto URL</label>
                                            <input type="text" class="form-control" name="img"
                                                value="<?= $data['img']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="add" class="btn btn-primary w-100">Edit</button>
                            </form>
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

</body>

</html>