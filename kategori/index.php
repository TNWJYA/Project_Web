<?php
    require_once '../layout/header.php';
    require_once '../layout/auth.php';
    require_once '../layout/navbar.php';

    $a = 1;
    $data_kategori = [];

    $sql = "SELECT * FROM kategori";
    $sql2 = $sql;

    if(isset($_POST['search'])){
        $search = $_POST['search'];
        if($search != ''){
            $sql2 = "SELECT * FROM kategori WHERE nama_kategori='$search'";
        }
    }

    $query = mysqli_query($conn,$sql) or trigger_error("query error: ".mysqli_error($conn));

    $query2 = mysqli_query($conn,$sql2);
    while($data = mysqli_fetch_assoc($query2)){
        $data_kategori[] = [
            'nama_kategori' => $data['nama_kategori'],
            'id_kategori' => $data['id_kategori']
        ];
    }

?>
<!--Tambah Kategori-->

<div align="center">
    <a href="add.php" class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">Tambah Kategori</a>
</div>
<!--Tambah Ketgori End-->

<!-- Service Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h1 class="mb-0">Silahkan Pilih Kategori Diskusi</h1>
        </div>
        <div class='text-center mb-5'>
            <!-- Search Input -->
            <form action="" method="post">
                <input name='search' class="form-control p-3" list="datalistOptions" id="exampleDataList"
                    placeholder="Cari Judul Diskusi ...">
                <datalist id="datalistOptions">
                    <?php while($dt = mysqli_fetch_assoc($query)): ?>
                    <option value="<?= $dt['nama_kategori'] ?>">
                    <?php endwhile; ?>
                </datalist>
            </form>
            <!-- End Search Input -->
        </div>
        <div class="row g-5">
            <?php foreach($data_kategori as $data): ?>
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                <div
                    class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="service-icon">
                        <i class="fa fa-users text-white"></i>
                    </div>
                    <h4 class="mb-3"><?= $data['nama_kategori'] ?></h4>
                    <a class="btn btn-lg btn-primary rounded" href="detail.php?id=<?= $data['id_kategori'] ?>">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Service End -->
<?php 
    require_once '../layout/footer.php';
?>