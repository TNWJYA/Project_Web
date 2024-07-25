<?php 

require '../conn.php';

$as = $_POST['as'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM $as WHERE email='$email' AND password='$password'";
$query = mysqli_query($conn, $sql);

if(mysqli_num_rows($query) > 0){
    $_SESSION['login'] = true;
    $user = mysqli_fetch_assoc($query);
    $_SESSION['loginData'] = [
        'user_id' => $user['id_'.$as],
        'nama' => $user['nama'],
        'img' => $user['img'],
        'role' => $as,
    ];
    // var_dump($as);
    // exit;
    if($as == 'admin'){
        $_SESSION['loginData']['level'] = $user['level'];
        header("Location: ../admin/admin");
    }else{
        header("Location: ../kategori/index.php");
    }
}else{
    echo "<script LANGUAGE='JavaScript'>
            window.alert('".$as." tidak ditemukan');
            window.location.href= 'login_".$as.".php';
        </script>";
exit;
}