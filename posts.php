<?php
$link = mysqli_connect('localhost', 'root', 'sphdx', 'first');

$id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE id = '$id'";
$res = mysqli_query($link, $sql);
$rows = mysqli_fetch_array($res);
$title = $rows['title'];
$mainText = $rows['main_text'];
$image = $rows['image'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Посты</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-light bg-light p-3">
    <div class="container-fluid">
        <a href="#" class="navbar-brand d-flex align-items-center">
            <img src="logo.png" alt="логотип-сайта" class="me-2">
            <span>Мой сайт</span>
        </a>
        <div>
            <a href="profile.php" class="btn btn-outline-primary">Профиль</a>
            <a href="index.php" class="btn btn-outline-danger">Выйти</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-md-8 mx-auto text-center">
            <?php
            echo "<h1> $title </h1>";

            if (!empty($image)) {
                echo "<img src='$image' class='img-fluid rounded shadow my-4 post-image'>";
            }

            echo "<h2> $mainText </h2>";
            ?>
        </div>
    </div>
</div>

</body>
</html>