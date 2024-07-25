<?php
    require_once '../layout/header.php';
    require_once '../layout/navbar.php';
?>
    <!--  Card Content -->
    <main class="container mt-5">
        <div class="card border-primary col-md-7 mx-auto">
            <div class="card-body">

                <div id="title" class="text-center mt-3">
                    <h3>Login User</h3>
                </div>
                <form action="login_act.php" class="p-4" method='post'>
                <input type="hidden" name="as" value='user'>
                    <div class="mb-5">
                        <label for="input" class="form-label fs-5">Email</label>
                        <input type="text" name='email' class="form-control p-3" id="input" placeholder="Masukkan Email" required>
                    </div>
                    <div class="mb-5">
                        <label for="input" class="form-label fs-5">Password</label>
                        <input type="password" name='password' class="form-control p-3" placeholder="Masukkan Password" required>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-lg col-12">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- End Card Content -->
<?php 
    require_once '../layout/footer.php';
?>