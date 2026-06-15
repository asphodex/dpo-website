<?php

$host = "db";
$user = "root";
$password = "sphdx";
$dbName = "first";

$link = mysqli_connect($host, $user, $password);
if (!$link) {
    die('Could not connect: ' . mysqli_error($link));
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbName";

if (!mysqli_query($link, $sql)) {
    echo "Error creating database $dbName: " . mysqli_error($link);
}

mysqli_close($link);

$link = mysqli_connect($host, $user, $password, $dbName);

$sql = "CREATE TABLE IF NOT EXISTS users(
    id  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
)";

if (!mysqli_query($link, $sql)) {
    echo "Error creating table users: " . mysqli_error($link);
}

$sql = "CREATE TABLE IF NOT EXISTS posts(
    id  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(20) NOT NULL,
    main_text VARCHAR(400) NOT NULL,
    image VARCHAR(255)
)";

if (!mysqli_query($link, $sql)) {
    echo "Error creating table posts: " . mysqli_error($link);
}

mysqli_close($link);
