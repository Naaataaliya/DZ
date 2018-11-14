<?php
session_start();
if (!$_SESSION['name']) {
header("Location:index.php");
  exit;
}

$fileList = glob('uploads/*.json');
if (!isset($_GET['test'])) {
        http_response_code(404);
?>
     <p>Такого теста не существует</p>
     <p><a href="list.php">Список тестов</a></p>
     <p><a href="sessionDestroy.php">Выйти</a></p>
<?php
    exit;
} 
foreach ($fileList as $key => $file) {
    if (empty(array_key_exists($_GET['test'], $fileList))) {
      http_response_code(404);
      ?>
     <p>Такого теста не существует</p>
     <p><a href="list.php">Список тестов</a></p>
     <p><a href="sessionDestroy.php">Выйти</a></p>
<?php
    exit;
    }
    elseif ($key == $_GET['test']) {
        $fileTest = file_get_contents($fileList[$key]);
        $decodeFile = json_decode($fileTest, true);
        $test = $decodeFile;
    }
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тесты</title>
</head>
<body>
  <form action="" method="post" enctype=multipart/form-data>
    <fieldset>
      <legend><h3><?= $test[0]['question'] ?></h3></legend>


<?php
for ($i = 0; $i < count($test[0]['items']); $i++) {
?>
     <p><h4><?= $test[0]['items'][$i]['quest'] ?></h4></p>
    <?php
    for ($k = 0; $k < count($test[0]['items'][$i]['answers']); $k++) {
        $arrResultRight[] = $test[0]['items'][$i]['answers'][$k]['result'];
?>
     <label><input type=radio name="<?= $i ?>" value="<?= $test[0]['items'][$i]['answers'][$k]['answer'] ?>"><?= $test[0]['items'][$i]['answers'][$k]['answer'] ?></label>
    <?php
    }
}
?>
   </fieldset>
    <input class="add" type="submit" name="" value="Отправить">
  </form> 
 <?php
if (empty($_POST)) {
?>
     <p>Введите данные</p>
      <p><a href="list.php">Список тестов</a></p>
      <p><a href="sessionDestroy.php">Выйти</a></p>
<?php
    exit;
} else {
    foreach ($test[0]['items'] as $key => $value) {
        for ($i = 0; $i < count($_POST); $i++) {
            if ($i == $key) {
                for ($k = 0; $k < count($test[0]['items'][$i]['answers']); $k++) {
                    if ($_POST[$i] === $test[0]['items'][$i]['answers'][$k]['answer']) {
                        $arrResult[] = $test[0]['items'][$i]['answers'][$k]['result'];
                    }
                }
            }
        }
    }
}
if (!empty($arrResult)) {
  $arrResult = array_sum($arrResult);
}

$arrResultRight = array_sum($arrResultRight);
function clean($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    
    return $value;
}
$name=clean($_SESSION['name']);
if ($arrResult === $arrResultRight) {
?>

    <p><a href='list.php'>Другой тест</a></p>
    <p><a href="sessionDestroy.php">Выйти</a></p>
<?php
} else {
?>
     <h4>Попробуйте еще раз</h4>
     <p><a href="list.php">Список тестов</a></p>
     <p><a href="sessionDestroy.php">Выйти</a></p>
<?php
}
?>

</body>
</html>