<?php
    session_start();

    DEFINE('DBUSER', 'root');
    DEFINE('DBPW', '');
    DEFINE('DBHOST', 'localhost');
    DEFINE('DBNAME', 'diskusi');

    $conn = mysqli_connect(DBHOST,DBUSER,DBPW,DBNAME);

    if(!$conn){
        die("Database connection failed: " . mysqli_error($conn));
        exit();
    }