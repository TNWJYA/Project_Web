    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="../kategori/index.php" class="navbar-brand p-0">
                <img src="../images/logojabar.png" width="50" alt="US">
                Forum Diskusi Online Warga Desa Cibodas Lembang
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="../kategori/index.php" class="nav-item nav-link">Home</a>
                    <?php if(!isset($_SESSION['login'])): ?>
                    <a href="../auth/login_admin.php" class="nav-item nav-link">Login Admin</a>
                    <a href="../auth/login_user.php" class="nav-item nav-link">Login User</a>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['login'])): ?>
                    <?php if($_SESSION['loginData']['role'] == 'admin'): ?>
                    <a href="../report/index.php" class="nav-item nav-link">Report</a>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php if(isset($_SESSION['login'])): ?>
                &nbsp;
                &nbsp;
                &nbsp;
                <div class="dropdown dropleft">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="<?= $_SESSION['loginData']['img'] == null ? 'https://ui-avatars.com/api/?name='. $_SESSION['loginData']['nama'] .'' : $_SESSION['loginData']['img'] ?>"
                            width="40" alt="">
                        <span class='text-light'><?= $_SESSION['loginData']['nama'] ?></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php if($_SESSION['loginData']['role'] == 'user'): ?>
                        <a class="dropdown-item" href="../user/detail.php">Detail User</a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="../auth/logout_act.php">Logout</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
    </div>

    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
    </div>
    <!-- Navbar End -->