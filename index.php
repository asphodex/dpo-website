<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Цветков Алексей</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="mb-4">Войдите</h1>
            <?php

            if (!isset($_COOKIE['User'])){
            ?>
            <div class="d-flex justify-content-center gap-3">
                <a href="registration.php" class="btn btn-primary">Регистрация</a>
                <a href="login.php" class="btn btn-primary">Логин</a>
            </div>
            <?php
            } else {
                $link = mysqli_connect('db', 'root', 'sphdx', 'first');
                $sql = "SELECT * FROM posts";
                $res = mysqli_query($link, $sql);
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_array($res)) {
                        echo "<a href='posts.php?id=" . $row['id'] . "'>" . $row['title'] . "</a><br>";
                    }
                } else {
                    echo "No posts";
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
