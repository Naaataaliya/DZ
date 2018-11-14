<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
 <link rel="stylesheet" type="text/css" href="styles/styleLoginForm.css" />   
    <title>Авторизация</title>
</head>

<body>
<div class="container">
	<section id="content">
		<form action="actionLoginForm.php" method="post" enctype="multipart/form-data">
			<h1>Авторизация</h1>
			<div>
				<input type="text" placeholder="Username" name="username">
			</div>
			<div>
				<input type="password" placeholder="Password" name="password">
			</div>
			<div>
				<input type="submit" value="Войти">
<!-- 				<a href="#">Выйти</a> -->
			</div>
		</form>
		
	</section>
</div>
</body>
</html>