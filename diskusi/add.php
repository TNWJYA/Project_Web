<?php
    require_once '../layout/header.php';
    require_once '../layout/auth.php';
    require_once '../layout/navbar.php';

    $id = $_GET['id'];

    $sql = "SELECT diskusi.judul_diskusi, COUNT(diskusi.id_diskusi) AS 'count_comment' 
    FROM diskusi JOIN diskusi_chat ON diskusi.id_diskusi = diskusi_chat.id_diskusi 
    WHERE diskusi.id_kategori='$id'
    GROUP BY diskusi.id_diskusi ORDER BY count_comment DESC";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query) > 0){
        $pop = mysqli_fetch_assoc($query);
    }else{
        $pop['judul_diskusi'] = '';
        $pop['count_comment'] = '';
    }
?>
<!--  Card Content -->
<main class="container mt-5">
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="bg-primary text-dark col-12 p-2 text-center rounded">Judul Diskusi Terpopuler</div>
            <div class="btn btn-primary card border-info col-12 p-2 mt-5 text-center rounded"><a href="diskusi.html">
                    <h5><?= $pop['judul_diskusi'] ?></h5>
                </a>
                <div class="d-flex justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="text-black" class="bi bi-chat"
                        viewBox="0 0 16 16">
                        <path
                            d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                    </svg>

                    <span class="ms-2 fs-4 text-black"><?= $pop['count_comment'] ?></span>
                </div>
            </div>

        </div>
        <div class="col-md-9 mt-lg-0 mt-4">
            <div class="card border">
                <div class="card-body">
                    <form action="add-act.php" method='POST'>
                        <input type="hidden" name='id_kategori' value="<?= $id ?>">
                        <div class="my-4">
                            <h5 for="title" class="form-label text-bold">Judul Diskusi</h5>
                            <input type="text" name='title' class="form-control" id="title"
                                placeholder="Masukkan Judul Diskusi">
                        </div>
                        <div class="text-center mt-4">
                            <button class="btn btn-primary btn-lg col-10">Posting Judul Diskusi</button>
                        </div>
                        <div class="text-center mt-4 box-header">
                            <a href="../kategori/detail.php?id=<?= $id ?>" class="btn btn-primary btn-sm pull"><i
                                    class="fa fa-reply"></i> &nbsp Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
</main>
<!-- End Card Content -->
<?php 
    require_once '../layout/footer.php';
?>