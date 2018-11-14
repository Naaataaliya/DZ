<?php
session_start();
include('actions/functionRedirect.php');

$fileList = glob('uploads/*.json');

foreach ($fileList as $key => $value) {
	        $fileTest = file_get_contents($fileList[$key]);

        $decodeFile = json_decode($fileTest, true);
        $test = $decodeFile;

	?>
<!doctype html>
<html lang="ru">
<head>
	<body>
		<form method="post" action="actionDelete.php" enctype="multipart/form-data">
            <p><label><input type=radio name="<?=$key?>" value="<?=$value?>"><?= $test[0]['question'] ?></label></p>

	<?php
}

?>            
            <input type="submit" name="" value="Удалить">
        </form>	
        <p><a href="list.php">Список тестов</a></p>
        <p><a href="sessionDestroy.php">Выйти</a></p>
	</body>
</head>
</html>