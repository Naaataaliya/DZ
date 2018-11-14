<?php
session_start();
include('actions/functionRedirect.php');

if (isset($_POST['add']) && empty($_FILES['testfile']['name'])) {
    header("Location:admin.php");
    exit;
}
elseif (isset($_POST) && isset($_FILES) && isset($_FILES['testfile'])) {
    $fileName = $_FILES['testfile']['name'];
    $tmpFile = $_FILES['testfile']['tmp_name'];
    $uploadsDir = 'uploads/';

    $pathInfo = pathinfo($uploadsDir . $fileName);

    if ($pathInfo['extension'] === 'json') {
        move_uploaded_file($tmpFile, $uploadsDir . $fileName);
        header("Location:list.php");
        exit;
    } else {
        header("Location:admin.php");
        exit;
    }        
} 
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузить тест</title>
</head>
<body>

    <div>
        <p>Загрузите  тест </p>


        <form method="post" enctype="multipart/form-data">
            <input type="file" name="testfile">
            <input type="submit" name="add" value="Загрузить">
        </form>

        <ul>
            <li><a href="list.php">Список тестов</a></li>
            <li><a href="delete.php">Удалить тест</a></li>
            <li><a href="sessionDestroy.php">Выйти</a></li>
        </ul>
    </div>

</body>
</html>