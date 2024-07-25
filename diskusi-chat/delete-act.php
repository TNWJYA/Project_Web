<?php 
    require_once '../conn.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM diskusi_chat WHERE id_diskusi_chat='$id'";
    $query = mysqli_query($conn,$sql);

    if($_SESSION['loginData']['role'] == 'user'){
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }else{
        header("Location: ../report/index.php");
    }

    exit;
?>