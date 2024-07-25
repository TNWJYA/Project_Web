<?php
    require_once '../layout/header.php';
    require_once '../layout/auth.php';
    require_once '../layout/navbar.php';

    $id = $_SESSION['loginData']['user_id'];

    $sql = "SELECT * FROM diskusi WHERE id_creator='$id'";
    $query = mysqli_query($conn, $sql);
    $jumlahDiskusi = mysqli_num_rows($query);

    $sql = "SELECT * FROM diskusi_chat WHERE id_user='$id'";
    $query = mysqli_query($conn, $sql);
    $jumlahKomentar = mysqli_num_rows($query);

    $sql = "SELECT * FROM user WHERE id_user='$id'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);
?>
    <!--  Card Content -->
    <main class="container mt-5">
        <div class="card border-primary col-md-7 mx-auto">
            <div class="card-body">

                <div id="title" class="text-center mt-3">
                    <h3>Profil User</h3>
                </div>
                <form action="edit-act.php" class="p-4" method='post'>
                    <input type="hidden" value='<?= $id ?>' name='id'>
                    <div class="mb-3">
                        <label for="input" class="form-label fs-5">Image Profile</label><br>
                        <img src="<?= $data['img'] == null ? 'https://ui-avatars.com/api/?name='.$data['nama'] : $data['img'] ?>">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="input" class="form-label fs-5">Jumlah Diskusi yang dibuat</label>
                                <input type="text" class="form-control p-3" value="<?= $jumlahDiskusi ?>" disabled>
                            </div>
                            <div class="col">
                            <label for="input" class="form-label fs-5">Jumlah komentar</label>
                                <input type="text" class="form-control p-3" value="<?= $jumlahKomentar ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label fs-5">Email</label>
                        <input type="email" class="form-control p-3" name='email' value='<?= $data['email'] ?>' placeholder="Masukkan Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label fs-5">Password</label>
                        <input type="password" class="form-control p-3" name='pass' placeholder="Masukkan Password">
                        <small class='text-danger'>Kosongkan jika tidak ingin diubah</small>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label fs-5">Nama</label>
                        <input type="text" class="form-control p-3" name='nama' value='<?= $data['nama'] ?>' placeholder="Masukkan Nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label fs-5">no HP</label>
                        <input type="number" class="form-control p-3" name='hp' value='<?= $data['no_hp'] ?>'placeholder="Masukkan no HP" required>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label fs-5">ImageURL</label>
                        <input type="text" class="form-control p-3" name='img'  value='<?= $data['img'] ?>' placeholder="Masukkan imageURL">
                    </div>
                    <div>
                        <button class="btn btn-primary btn-lg col-12" type='submit'>Ubah</button>
                    </div>
                    <div class="text-center mt-4 box-header">
                        <a href="../kategori/index.php" class="btn btn-primary btn-sm pull"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- End Card Content -->
<?php 
    require_once '../layout/footer.php';
?>