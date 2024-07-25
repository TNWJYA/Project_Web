<?php
require_once '../conn.php';

$file = $_FILES['file'];
$name =  $file['name'];

$id = $_POST['id'];
$id_user = $_SESSION['loginData']['user_id'];
$content = $_POST['content'];
$datetime = date("Y-m-d H:i:s");

if($name != null){
    $TmpName = $file['tmp_name'];
    
    $ext = explode('.',$name);
    $Actualext = strtolower(end($ext));
    $new_name = uniqid('',true).".$Actualext";
    $path = 'img/'.$new_name;
    $upload = move_uploaded_file($TmpName,$path);
    
    if(isset($_POST['reply'])){
        $parent_id = $_POST['reply'];
        $sql = "INSERT INTO diskusi_chat VALUES('', $parent_id, '$id_user', '$id', '$new_name', '$content', '$datetime')";
    }else{
        $sql = "INSERT INTO diskusi_chat VALUES('', NULL, '$id_user', '$id', '$new_name', '$content', '$datetime')";
    }
}else{
    if(isset($_POST['reply'])){
        $parent_id = $_POST['reply'];
        $sql = "INSERT INTO diskusi_chat VALUES('', $parent_id, '$id_user', '$id', '$new_name', '$content', '$datetime')";
    }else{
        $sql = "INSERT INTO diskusi_chat VALUES('', NULL, '$id_user', '$id', NULL, '$content', '$datetime')";
    }
}

$query = mysqli_query($conn,$sql);
if($query){
    header("Location: detail.php?id=".$id."");
}else{
    echo mysqli_error($conn);
}
