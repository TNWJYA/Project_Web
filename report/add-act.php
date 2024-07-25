<?php
    require_once '../conn.php';

    $id_user = $_POST['id_user'];
    $id_chat = $_POST['id_chat'];
    $id_diskusi = $_POST['id_diskusi'];
    $jenis = $_POST['jenis'];
    $alasan = $_POST['alasan'];

    // var_dump($jenis);
    // exit;

    $sql = "INSERT INTO report VALUES('', '$id_user', '$id_chat', '$jenis', '$alasan')";
    mysqli_query($conn,$sql);

    header("Location: ../diskusi-chat/detail.php?id=$id_diskusi");