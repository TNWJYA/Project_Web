<?php
    session_start();

    session_destroy();
    session_unset();

    header("Location: ../auth/login_admin.php");