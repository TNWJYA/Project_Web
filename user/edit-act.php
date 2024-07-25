<?php
require_once '../conn.php';

$id = $_POST['id'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$img = $_POST['img'];

if($pass != null){
    $sql = "UPDATE user SET email='$email', password='$pass', nama='$nama', no_hp='$hp', img='$img' WHERE id_user='$id'";
}else{
    $sql = "UPDATE user SET email='$email', nama='$nama', no_hp='$hp', img='$img' WHERE id_user='$id'";
}

$_SESSION['loginData']['nama'] = $nama;
$_SESSION['loginData']['img'] = $img;
$edit = mysqli_query($conn,$sql);

header("Location: detail.php");