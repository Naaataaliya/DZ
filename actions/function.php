<?php
$fileList = glob('users/*.json');
$accessCheck = 'users/'.$_SESSION['name'].'.json';
if (!in_array($accessCheck, $fileList)) {
	http_response_code(403);
	exit;
} else {
	$login=file_get_contents('users/admin.json');
	$login=json_decode($login, true);	
}
if ($_SESSION['password'] !== $login[0]['pass']) {
    http_response_code(403);
    exit;
}

?>