<?php
    require_once '../conn.php';

    $judul = $_POST['title'];
    $id_kategori = $_POST['id_kategori'];
    $id_user = $_SESSION['loginData']['user_id'];

    $sql = "INSERT INTO diskusi VALUES('', '$id_user', '$id_kategori', '$judul')";
    mysqli_query($conn,$sql);

    header("Location: ../kategori/detail.php?id=".$id_kategori."");