<?php
foreach ($_POST as $value) {
	unlink($value);
}
header("Location: list.php");
?>