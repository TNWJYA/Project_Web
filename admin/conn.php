<?php

DEFINE('DBUSER', 'root');
DEFINE('DBPW', '');
DEFINE('DBHOST', 'localhost');
DEFINE('DBNAME', 'diskusi');

$conn = mysqli_connect(DBHOST,DBUSER,DBPW,DBNAME);

if(!$conn){
    die("Database connection failed: " . mysqli_error($conn));
    exit();
}

function query($sql){
    global $conn;
    $query = mysqli_fetch_assoc(mysqli_query($conn ,$sql));

    return $query;
}