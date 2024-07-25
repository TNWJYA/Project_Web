<?php
    require_once '../layout/header.php';
    require_once '../layout/auth.php';
    require_once '../layout/navbar.php';
    if($_SESSION['loginData']['role'] == 'user'){
        header("Location: ../kategori/index.php");
    }

    $sql = "SELECT * FROM report JOIN user ON report.id_user = user.id_user
    JOIN diskusi_chat ON diskusi_chat.id_diskusi_chat = report.id_diskusi_chat";
    $query = mysqli_query($conn,$sql);
    $a = 1;
?>
<main class="container mt-5 mb-5">
    <h1>
        Daftar Report
    </h1>
    <!-- Table -->
    <div class="card border-primary">
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Member</th>
                            <th scope="col">Isi Chat</th>
                            <th scope="col">Jenis Pelanggaran</th>
                            <th scope="col">Alasan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($data = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <th scope="row"><?= $a++ ?></th>
                            <td align="center"><?= $data['nama'] ?></td>
                            <td align="center"><?= $data['content'] ?></td>
                            <td align="center"><?= $data['jenis_pelanggaran'] ?></td>
                            <td align="center"><?= $data['alasan'] ?></td>
                            <?php $id_diskusi = $data['id_diskusi'] ?>
                            <td align="center"><a href="../diskusi-chat/detail.php?id=<?= $id_diskusi ?>">Go to Dicussion Page</a></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Table -->
</main>
<?php 
    require_once '../layout/footer.php';
?>