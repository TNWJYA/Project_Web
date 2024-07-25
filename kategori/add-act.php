<?php
require_once '../conn.php';

$nama = $_POST['nama'];

$query = "INSERT INTO kategori VALUES('', '$nama')";
$insert = mysqli_query($conn,$query);

header("Location: index.php");
