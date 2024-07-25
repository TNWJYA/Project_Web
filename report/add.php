<?php
    require_once '../layout/header.php';
    require_once '../layout/auth.php';
    require_once '../layout/navbar.php';

    $id = $_GET['id_chat'];

    $sql = "SELECT * FROM diskusi_chat JOIN user ON diskusi_chat.id_user = user.id_user
    WHERE id_diskusi_chat='$id'";
    $query = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($query);

?>
<main class="container mt-5">
    <div class="card border-primary col-md-7 mx-auto">
        <div class="card-body">
            <form action="add-act.php" method="post">
                <input type="hidden" name="id_chat" value="<?= $id ?>">
                <input type="hidden" name="id_diskusi" value="<?= $data['id_diskusi'] ?>">
                <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
                <div id="title" class="text-center mt-3">
                    <h3>Forum Diskusi Online Warga Desa Cibodas Lembang <br> </h3>
                    <p class="mt-3 text-dark fs-4">Laporkan Member</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fs-5">Nama Member</label>
                    <input type="text" class='form-control' value='<?= $data['nama'] ?>' disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label fs-5">Chat Member</label>
                    <input type="text" class='form-control' value='<?= strip_tags($data['content']) ?>' disabled>
                </div>
                <div class="mb-3">
                    <label for="Pelanggaran" class="form-label fs-5">Jenis Pelanggaran</label>
                    <select name="jenis" class="form-control p-3" id="Pelanggaran" required
                        aria-placeholder="Jenis Pelanggaran">
                        <option value="">Pilih Jenis Pelanggaran</option>
                        <option value="Berkata Kasar">Berkata Kasar</option>
                        <option value="Ujaran Kebencian">Ujaran Kebencian</option>
                        <option value="Spam">Spam</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label for="alasan" class="form-label fs-5">Alasan</label>
                    <textarea name="alasan" class="form-control p-3" id="" cols="30"
                        placeholder="Silahkan masukkan alasan laporan anda disini...." required rows="10"></textarea>
                </div>
                <div>
                    <button class="btn btn-primary btn-lg col-12">Kirimkan</button>
                </div>
                <div class="text-center mt-4 box-header">
                    <a href="index.html" class="btn btn-primary btn-sm pull"><i class="fa fa-reply"></i> &nbsp
                        Kembali</a>
                </div>
            </form>
        </div>
    </div>
</main>
<?php 
    require_once '../layout/footer.php';
?>