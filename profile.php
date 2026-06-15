<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>

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
        <?php if (isset($_COOKIE['User'])): ?>
            <form action="/logout.php" method="POST" class="d-flex">
                <button class="btn btn-outline-danger" type="submit">Выйти</button>
            </form>
        <?php endif; ?>
    </div>
</nav>

<div class="container mt-5">
    <div class="story-container">
        <div class="story-text">
            <p>
                Привет! Меня зовут Цветков Алексей. Я студент, увлекаюсь программированием.
            </p>
        </div>
        <img src="photo1.jpg" alt="фото_профиля" class="profile-img">
    </div>

    <div class="text-center mt-4">
        <button id="toggleButton" class="btn btn-primary">Открыть</button>
    </div>
    <div id="extraImage" class="mt-3 text-center" style="display: none;">
        <img class="profile-img" src="photo2.jpg" alt="скрытое_фото">
    </div>

    <div class="mt-5">
        <h2 class="text-center mb-4">Добавить новый пост</h2>
        <form action="profile.php" id="postForm" class="d-flex flex-column gap-3" method="POST"
              enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label" for="postTitle">Название поста</label>
                <input type="text" name="postTitle" class="form-control app-input" id="postTitle"
                       placeholder="Введите название" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="postContent">Текст поста</label>
                <textarea name="postContent" class="form-control app-input" id="postContent" placeholder="Введите текст"
                          rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="file">Добавить файл</label>
                <input type="file" name="file" class="form-control app-input" id="file">
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Сохранить пост</button>
        </form>
    </div>
</div>

<script src="js/script.js"></script>
</body>
</html>

<?php

if (!isset($_COOKIE['User'])) {
    header('location: /index.php');
    exit();
}

require_once('db.php');
$link = mysqli_connect('db', 'root', 'sphdx', 'first');

if (isset($_POST['submit'])) {
    $title = $_POST['postTitle'];
    $mainText = $_POST['postContent'];

    if (!$title || !$mainText) die("Title and text fields are required");

    $image = '';

    if (!empty($_FILES['file'])) {
        if ((($_FILES['file']['type'] == 'image/gif') ||
                        ($_FILES["file"]["type"] == "image/jpeg") ||
                        ($_FILES["file"]["type"] == "image/jpg") ||
                        ($_FILES["file"]["type"] == "image/pjpeg") ||
                        ($_FILES["file"]["type"] == "image/x-png") ||
                        ($_FILES["file"]["type"] == "image/png")) &&
                ($_FILES["file"]["size"] < 1024000)) {
            $image = "upload/" . $_FILES["file"]["name"];

            move_uploaded_file($_FILES["file"]["tmp_name"],
                    "upload/" . $_FILES["file"]["name"]);

            echo "Loaded in: " . "upload/" . $_FILES["file"]["name"];
        } else {
            echo "Upload failed";
        }
    }

    $sql = "INSERT INTO posts (title, main_text, image)
            VALUES ('$title', '$mainText', '$image')";

    if (!mysqli_query($link, $sql)) {
        die("Error insert data post");
    }
}
