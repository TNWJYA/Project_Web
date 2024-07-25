<?php
    require_once '../layout/header.php';
    require_once '../layout/auth.php';
    require_once '../layout/navbar.php';
?>
    <!--  Card Content -->
    <main class="container mt-5">
        <div class="card border-primary col-md-7 mx-auto">
            <div class="card-body">

                <div id="title" class="text-center mt-3">
                    <h3>Forum Diskusi Warga Desa Cibodas <br> Lembang</h3>
                    <p class="mt-3 text-info fs-4">Tambah Kategori</p>
                </div>
                <form action="add-act.php" class="p-4" method='post'>
                    <div class="mb-5">
                        <label for="input" class="form-label fs-5">Nama Kategori</label>
                        <input type="text" class="form-control p-3" id="input" name='nama' placeholder="Masukkan nama kategori" required>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-lg col-12" type='submit'>Tambah</button>
                    </div>
                    <div class="text-center mt-4 box-header">
                        <a href="index.php" class="btn btn-primary btn-sm pull"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- End Card Content -->
<?php 
    require_once '../layout/footer.php';
?>