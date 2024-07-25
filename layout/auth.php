<?php
function checkLogin(){
    if(!isset($_SESSION['login'])){
        header("Location: ../auth/login_user.php");
    }
}

checkLogin();