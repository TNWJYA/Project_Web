<?php
    require_once '../layout/header.php';
    require_once '../layout/auth.php';
    require_once '../layout/navbar.php';

    $id = $_GET['id'];
    $sql_kategori = "SELECT * FROM kategori WHERE id_kategori='$id'";
    $query_kategori = mysqli_query($conn,$sql_kategori) or trigger_error("query error: ".mysqli_error($conn));
    $data_kategori = mysqli_fetch_assoc($query_kategori);

    $sql = "SELECT * FROM diskusi
            JOIN user ON diskusi.id_creator = user.id_user
            WHERE diskusi.id_kategori='$id'";
    $query = mysqli_query($conn,$sql) or trigger_error("query error: ".mysqli_error($conn));
    $a = 1;

?>
<main class="container mt-5">

    <h4 class="mt-5">Kategori : <?= $data_kategori['nama_kategori'] ?></h4>

    <div class="align-self-center mt-lg-0 mt-2">
        <div class="d-md-flex justify-content-between">
            <div class="align-self-center  mt-4 col-md-2 p-2 text-center">
                <a href="../diskusi/add.php?id=<?= $id ?>" class="btn btn-primary col-12">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    Tambah Judul Diskusi Baru
                </a>
            </div>
        </div>

        <div align="right">
            <div class="box-header">
                <a href="index.php" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp;
                    Kembali</a>
            </div>
            <!-- Table -->
            <div class="card border-primary mt-5 mb-5">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="DataTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul Diskusi</th>
                                    <th scope="col">Pembuat Diskusi</th>
                                    <th scope="col">Jumlah Member</th>
                                    <th scope="col">Total Komentar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    while($data = mysqli_fetch_assoc($query)): 
                                    $id_diskusi = $data['id_diskusi'];
                                    $sql = "SELECT * FROM diskusi_chat WHERE id_diskusi ='$id_diskusi'";
                                    $query_komentar = mysqli_query($conn,$sql);
                                    $jumlah_komentar = mysqli_num_rows($query_komentar);

                                    $sql = "SELECT * FROM diskusi_chat 
                                    WHERE id_diskusi = '$id_diskusi'
                                    GROUP BY id_user";
                                    $query_member = mysqli_query($conn,$sql);
                                    $jumlah_member = mysqli_num_rows($query_member);
                                ?>
                                <tr>
                                    <th scope="row"><?=$a++ ?></th>
                                    <td>
                                        <a class="text-decoration-none"
                                            href="../diskusi-chat/detail.php?id=<?= $data['id_diskusi'] ?>">
                                            <?= $data['judul_diskusi'] ?>
                                        </a>
                                    </td>
                                    <td align="center"><?= $data['nama'] ?></td>
                                    <td align="center"><?= $jumlah_member ?></td>
                                    <td align="center"><?= $jumlah_komentar ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Table -->
</main>

<!-- End Card Content -->
<?php 
    require_once '../layout/footer.php';
?>